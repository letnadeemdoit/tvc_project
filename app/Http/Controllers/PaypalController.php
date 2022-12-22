<?php

namespace App\Http\Controllers;

use App\Models\House;
use Carbon\Carbon;
use App\Models\Paypal\PaymentInfo;
use App\Models\Paypal\SubscriptionInfo;
use App\Models\Subscription;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Facades\PayPal;

/**
 * Paypal Docs:
 * https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/formbasics/
 * https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/Appx-websitestandard-htmlvariables/
 */
class PaypalController extends Controller
{
    public $paypal;
    public $price = 0;

    public function __construct()
    {
        $this->paypal = PayPal::setProvider();
        $this->paypal->getAccessToken();
    }

    /**
     * There should be no output at this point.  To process the POST data,
     * the submit_paypal_post() function will output all the HTML tags which
     * contains a FORM which is submited instantaneously using the BODY onload
     * attribute.  In other words, don't echo or printf anything when you're
     * going to be calling the submit_paypal_post() function.
     *
     * This is where you would have your form validation  and all that jazz.
     * You would take your POST vars and load them into the class like below,
     * only using the POST values instead of constant string expressions.
     *
     * For example, after ensureing all the POST variables from your custom
     * order form are valid, you might have:
     *
     * $p->addField('first_name', $_POST['first_name']);
     * $p->addField('last_name', $_POST['last_name']);
     *
     * @return string
     */
    public function process($plan, $billed)
    {
        $mode = config('paypal.mode');

        abort_if(
            !array_key_exists($plan, config("paypal.$mode.plans")) || !in_array($billed, ['monthly', 'yearly']),
            404
        );


        try {
            $paypalSubscription = $this->paypal->createSubscription([
                'plan_id' => config("paypal.$mode.plans.$plan.$billed")
            ]);

            if (isset($paypalSubscription['error'])) {
                Log::channel('paypal')->error('Create Subscription: ', [$paypalSubscription['error']]);
            } else {
                Subscription::create([
                    'user_id' => auth()->user()->user_id,
                    'house_id' => auth()->user()->HouseId,
                    'subscription_id' => $paypalSubscription['id'],
                    'plan_id' => config("paypal.$mode.plans.$plan.$billed"),
                    'plan' => $plan,
                    'period' => $billed,
                    'status' => $paypalSubscription['status'],
                    'application_context' => [
                        'brand_name' => config('app.name'),
                        'locale' => 'en-US',
                        'user_action' => 'SUBSCRIBE_NOW',
                        'payment_method' => [
                            'payer_selected' => 'PAYPAL',
                            'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
                        ],
                        'return_url' => route('dash.paypal.succeeded', [$plan, $billed]),
                        'cancel_url' => route('dash.paypal.canceled', [$plan, $billed])
                    ]
                ]);

                $redirectTo = null;
                foreach ($paypalSubscription['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        $redirectTo = $link['href'];
                    }
                }

                if ($redirectTo) {
                    return redirect($redirectTo);
                }
            }
        } catch (\Exception $e) {
            Log::channel('paypal')->error('Create Subscription: ', [$e->getMessage()]);

        }

        return redirect()->route('dash.plans-and-pricing')->with('status', 'Sorry we are unable to process your subscription right now please try again later or contact with you vendor.');
    }

    /**
     * @return string
     */
    public function succeeded($plan, $billed)
    {
        return redirect()->route('dash.plans-and-pricing')->with('status', "Thank you for your order! You have been successfully subscribed");
    }

    public function reviseSubscription($plan, $billed) {

        $paypalsubscription = Subscription::where([
            'user_id' => auth()->user()->user_id,
            ['status', '<>', 'CANCELLED']
        ])->latest()->first();

        $mode = config('paypal.mode');

        $start_date =  $paypalsubscription->updated_at->subDays(30);

        $data = [
            'plan_id' => config("paypal.$mode.plans.$plan.$billed"),
            'application_context' => [
                'brand_name' => config('app.name'),
                'locale' => 'en-US',
                'user_action' => 'SUBSCRIBE_NOW',
                'payment_method' => [
                    'payer_selected' => 'PAYPAL',
                    'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
                ],
                'return_url' => route('dash.paypal.succeeded', [$plan, $billed]),
                'cancel_url' => route('dash.paypal.canceled', [$plan, $billed])
            ],


        ];

        if ($billed === 'yearly'){
            $calculatedPrice4Upgrade = 0;
            $months = Carbon::now()->diffInMonths($start_date);
            switch ($months) {
                case 0:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 20;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 40;
                    }
                    break;
                case 1:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 18;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 36;
                    }
                    break;
                case 2:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 16;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 32;
                    }
                    break;
                case 3:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 14;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 28;
                    }
                    break;
                case 4:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 12;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 24;
                    }
                    break;
                case 5:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 10;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 20;
                    }
                    break;
                case 6:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 8;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 16;
                    }
                    break;
                case 7:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 6;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 12;
                    }
                    break;
                case 8:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 4;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 8;
                    }
                    break;
                case 9:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 2;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 4;
                    }
                    break;
                case 10:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 0;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 2;
                    }
                    break;
                case 11:
                    if (($paypalsubscription->plan === 'basic' && $plan === 'standard') || ($paypalsubscription->plan === 'standard' && $plan === 'premium')){
                        $calculatedPrice4Upgrade = 0;
                    } elseif($paypalsubscription->plan === 'basic' && $plan === 'premium') {
                        $calculatedPrice4Upgrade = 0;
                    }
                    break;
            }


            if ($calculatedPrice4Upgrade > 0) {
                $data['plan'] = [
                    'billing_cycles' => [
                        [
                            'sequence' => 1,
                            'total_cycles' => 0,
                            'pricing_scheme' => [
                                'fixed_price' => [
                                    'value' => $calculatedPrice4Upgrade,
                                    'currency_code' => 'USD'
                                ]
                            ]
                        ]
                    ]
                ];
            }
        }

        $paypalSubscription = $this->paypal->reviseSubscription($paypalsubscription->subscription_id, $data);

        $redirectTo = null;
        foreach ($paypalSubscription['links'] ?? [] as $link) {
            if ($link['rel'] === 'approve') {
                $redirectTo = $link['href'];
            }
        }

        if ($redirectTo) {
            Subscription::create([
                'user_id' => auth()->user()->user_id,
                'house_id' => auth()->user()->HouseId,
                'subscription_id' => $paypalsubscription->subscription_id,
                'plan_id' => config("paypal.$mode.plans.$plan.$billed"),
                'plan' => $plan,
                'period' => $billed,
                'status' => 'REVISING',
            ]);
            return redirect($redirectTo);
        }
        else{
            $error = $paypalSubscription['error'];
            return redirect()->route('dash.plans-and-pricing')->with('error', $error['message']);
        }


    }

    public function canceled($plan, $billed)
    {
        return redirect()->route('dash.plans-and-pricing')->with('status', 'You have been cancelled order.');
    }

    /**
     * Paypal is calling page for IPN validation...
     *
     * It's important to remember that paypal calling this script.  There
     * is no output here.  This is where you validate the IPN data and if it's
     * valid, update your database to signify that the user has payed.  If
     * you try and use an echo or printf function here it's not going to do you
     * a bit of good.  This is on the "backend".  That is why, by default, the
     * class logs all IPN data to a text file.
     *
     * @return string
     */
    public function ipn(Request $request)
    {
        if ($this->paypal->validateIpn()) {

            $txn_id = $this->paypal->ipnData['txn_id'];

            $paymentInfo = PaymentInfo::where('txnid', $txn_id)->first();

            // assign posted variables to local variables
            $item_name = $this->paypal->ipnData['item_name'];
            $business = $this->paypal->ipnData['business'];
            $item_number = $this->paypal->ipnData['item_number'];
            $payment_status = $this->paypal->ipnData['payment_status'];
            $mc_gross = $this->paypal->ipnData['mc_gross'];
            $payment_currency = $this->paypal->ipnData['mc_currency'];

            $receiver_email = $this->paypal->ipnData['receiver_email'];
            $receiver_id = $this->paypal->ipnData['receiver_id'];
            $quantity = $this->paypal->ipnData['quantity'];
            $num_cart_items = $this->paypal->ipnData['num_cart_items'];
            $payment_date = $this->paypal->ipnData['payment_date'];
            $first_name = $this->paypal->ipnData['first_name'];
            $last_name = $this->paypal->ipnData['last_name'];
            $payment_type = $this->paypal->ipnData['payment_type'];
            $payment_status = $this->paypal->ipnData['payment_status'];
            $payment_gross = $this->paypal->ipnData['payment_gross'];
            $payment_fee = $this->paypal->ipnData['payment_fee'];
            $settle_amount = $this->paypal->ipnData['settle_amount'];
            $memo = $this->paypal->ipnData['memo'];
            $payer_email = $this->paypal->ipnData['payer_email'];
            $txn_type = $this->paypal->ipnData['txn_type'];
            $payer_status = $this->paypal->ipnData['payer_status'];
            $address_street = $this->paypal->ipnData['address_street'];
            $address_city = $this->paypal->ipnData['address_city'];
            $address_state = $this->paypal->ipnData['address_state'];
            $address_zip = $this->paypal->ipnData['address_zip'];
            $address_country = $this->paypal->ipnData['address_country'];
            $address_status = $this->paypal->ipnData['address_status'];
            $item_number = $this->paypal->ipnData['item_number'];
            $tax = $this->paypal->ipnData['tax'];
            $option_name1 = $this->paypal->ipnData['option_name1'];
            $option_selection1 = $this->paypal->ipnData['option_selection1'];
            $option_name2 = $this->paypal->ipnData['option_name2'];
            $option_selection2 = $this->paypal->ipnData['option_selection2'];
            $for_auction = $this->paypal->ipnData['for_auction'];
            $invoice = $this->paypal->ipnData['invoice'];
            $custom = $this->paypal->ipnData['custom'];
            $notify_version = $this->paypal->ipnData['notify_version'];
            $verify_sign = $this->paypal->ipnData['verify_sign'];
            $payer_business_name = $this->paypal->ipnData['payer_business_name'];
            $payer_id = $this->paypal->ipnData['payer_id'];
            $mc_currency = $this->paypal->ipnData['mc_currency'];
            $mc_fee = $this->paypal->ipnData['mc_fee'];
            $exchange_rate = $this->paypal->ipnData['exchange_rate'];
            $settle_currency = $this->paypal->ipnData['settle_currency'];
            $parent_txn_id = $this->paypal->ipnData['parent_txn_id'];
            $pending_reason = $this->paypal->ipnData['pending_reason'];
            $reason_code = $this->paypal->ipnData['reason_code'];


            // subscription specific vars

            $subscr_id = $this->paypal->ipnData['subscr_id'];
            $subscr_date = $this->paypal->ipnData['subscr_date'];
            $subscr_effective = $this->paypal->ipnData['subscr_effective'];
            $period1 = $this->paypal->ipnData['period1'];
            $period2 = $this->paypal->ipnData['period2'];
            $period3 = $this->paypal->ipnData['period3'];
            $amount1 = $this->paypal->ipnData['amount1'];
            $amount2 = $this->paypal->ipnData['amount2'];
            $amount3 = $this->paypal->ipnData['amount3'];
            $mc_amount1 = $this->paypal->ipnData['mc_amount1'];
            $mc_amount2 = $this->paypal->ipnData['mc_amount2'];
            $mc_amount3 = $this->paypal->ipnData['mcamount3'];
            $recurring = $this->paypal->ipnData['recurring'];
            $reattempt = $this->paypal->ipnData['reattempt'];
            $retry_at = $this->paypal->ipnData['retry_at'];
            $recur_times = $this->paypal->ipnData['recur_times'];
            $username = $this->paypal->ipnData['username'];
            $password = $this->paypal->ipnData['password'];

            //auction specific vars

            $for_auction = $this->paypal->ipnData['for_auction'];
            $auction_closing_date = $this->paypal->ipnData['auction_closing_date'];
            $auction_multi_item = $this->paypal->ipnData['auction_multi_item'];
            $auction_buyer_id = $this->paypal->ipnData['auction_buyer_id'];

            if ($paymentInfo) {
                //	mail("noreply@thevacationcalendar.com", "VERIFIED DUPLICATED TRANSACTION", "$res\n $req \n $strQuery\n $struery\n  $strQuery2");

            } else {
                PaymentInfo::create([
                    'paymentstatus' => $payment_status,
                    'buyer_email' => $payer_email,
                    'firstname' => $first_name,
                    'lastname' => $last_name,
                    'street' => $address_street,
                    'city' => $address_city,
                    'state' => $address_state,
                    'zipcode' => $address_zip,
                    'country' => $address_country,
                    'mc_gross' => $mc_gross,
                    'mc_fee' => $mc_fee,
                    'itemnumber' => $item_number,
                    'itemname' => $item_name,
                    'on0' => $option_name1,
                    'os0' => $option_selection1,
                    'on1' => $option_name2,
                    'os1' => $option_selection2,
                    'quantity' => $quantity,
                    'memo' => $memo,
                    'paymenttype' => $payment_type,
                    'paymentdate' => $payment_date,
                    'txnid' => $txn_id,
                    'pendingreason' => $pending_reason,
                    'reasoncode' => $reason_code,
                    'tax' => $tax,
                    'datecreation' => date("Y") . date("m") . date("d"),
                ]);
                //	 mail("noreply@thevacationcalendar.com", "VERIFIED IPN", "$res\n $req\n $strQuery\n $struery\n  $strQuery2");
            }

            //subscription handling branch
            if ($txn_type == "subscr_signup" || $txn_type == "subscr_payment") {

                SubscriptionInfo::create([
                    'subscr_id' => $subscr_id,
                    'sub_event' => $txn_type,
                    'subscr_date' => $subscr_date,
                    'subscr_effective' => $subscr_effective,
                    'period1' => $period1,
                    'period2' => $period2,
                    'period3' => $period3,
                    'amount1' => $amount1,
                    'amount2' => $amount2,
                    'amount3' => $amount3,
                    'mc_amount1' => $mc_amount1,
                    'mc_amount2' => $mc_amount2,
                    'mc_amount3' => $mc_amount3,
                    'recurring' => $recurring,
                    'reattempt' => $reattempt,
                    'retry_at' => $retry_at,
                    'recur_times' => $recur_times,
                    'username' => $username,
                    'password' => $password,
                    'payment_txn_id' => $txn_id,
                    'subscriber_emailaddress' => $payer_email,
                    'datecreation' => date("Y") . date("m") . date("d"),
                    'custom' => $custom
                ]);


//                mail("noreply@thevacationcalendar.com", "VERIFIED IPN", "$res\n $req\n $strQuery\n $struery\n  $strQuery2");

                // Payment has been recieved and IPN is verified.  This is where you
                // update your database to activate or process the order, or setup
                // the database with the user's order details, email an administrator,
                // etc.  You can access a slew of information via the ipn_data() array.

                // Check the paypal documentation for specifics on what information
                // is available in the IPN POST variables.  Basically, all the POST vars
                // which paypal sends, which we send back for validation, are now stored
                // in the ipn_data() array.

                House::where('HouseID', $custom)->update(['Status' => 'A']);

                // For this example, we'll just email ourselves ALL the data.
                $subject = 'Instant Payment Notification - Recieved Payment';
                $to = 'admin@thevacationcalendar.com';    //  your email
                $body = "An instant payment notification was successfully received\n";
                $body .= "from " . $this->paypal->ipnData['payer_email'] . " on " . date('m/d/Y');
                $body .= " at " . date('g:i A') . "\n\nDetails:\n";

                foreach ($this->paypal->ipnData as $key => $value) {
                    $body .= "\n$key: $value";
                }
                mail("admin@thevacationcalendar.com", "Completed Setup of House " . $custom, "Start spreading the news");


            } elseif ($txn_type == "subscr_cancel") {

                SubscriptionInfo::create([
                    'subscr_id' => $subscr_id,
                    'sub_event' => $txn_type,
                    'subscr_date' => $subscr_date,
                    'subscr_effective' => $subscr_effective,
                    'period1' => $period1,
                    'period2' => $period2,
                    'period3' => $period3,
                    'amount1' => $amount1,
                    'amount2' => $amount2,
                    'amount3' => $amount3,
                    'mc_amount1' => $mc_amount1,
                    'mc_amount2' => $mc_amount2,
                    'mc_amount3' => $mc_amount3,
                    'recurring' => $recurring,
                    'reattempt' => $reattempt,
                    'retry_at' => $retry_at,
                    'recur_times' => $recur_times,
                    'username' => $username,
                    'password' => $password,
                    'payment_txn_id' => $txn_id,
                    'subscriber_emailaddress' => $payer_email,
                    'datecreation' => date("Y") . date("m") . date("d"),
                    'custom' => $custom
                ]);


                // insert subscriber info into paypal_subscription_info table
                House::where('HouseID', $custom)->update(['Status' => 'C']);
            }
        }
    }
}
