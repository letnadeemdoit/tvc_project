<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Models\Paypal\PaymentInfo;
use App\Models\Paypal\SubscriptionInfo;
use App\Models\User;
use App\Services\Paypal;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

/**
 * Paypal Docs:
 * https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/formbasics/
 * https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/Appx-websitestandard-htmlvariables/
 */
class PaypalController extends Controller
{
    public $paypal;

    public function __construct()
    {
        $this->paypal = new Paypal();

        if (config('services.paypal.mode') === 'sandbox') {
            $this->paypal->paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';   // testing paypal url
        } else {
            $this->paypal->paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';     // paypal url
        }
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
        abort_if(
            !array_key_exists($plan, User::PLANS) || !in_array($billed, ['monthly', 'yearly']),
            404
        );


        $this->paypal->addField('cmd', '_xclick-subscriptions');

        // Setup business on the base of live or sandbox
        if (config('services.paypal.mode') === 'sandbox') {
            $this->paypal->addField('business', 'admin_1223600237_biz@thevacationcalendar.com');
        } else {
            $this->paypal->addField('business', 'payment@thevacationcalendar.com');
        }

        // Setting the return URL on individual transactions
        // With Auto Return turned on in your account profile, you can set the value of the return URL on
        // each individual transaction to override the value that you have stored on PayPal. For example,
        // you might want to return the payer's browser to a URL on your site that is specific to that payer,
        // perhaps with a session ID or other transaction-related data included in the URL.
        //
        // To set the return URL for a transaction, include the return variable in the HTML FORM:
        $this->paypal->addField('return', route('dash.paypal.succeeded', [$plan, $billed, auth()->user()->HouseId]));

        // A URL to which PayPal redirects the buyers' browsers if they cancel checkout
        // before completing their payments. For example, specify a URL on your website that
        // displays the Payment Canceled page.
        //
        // By default, PayPal redirects the browser to a PayPal webpage. Character Length: 1,024
        $this->paypal->addField('cancel_return', route('dash.paypal.canceled', [$plan, $billed, auth()->user()->HouseId]));

        // The URL to which PayPal posts information about the payment,
        // in the form of Instant Payment Notification messages. Character Length: 255
        $this->paypal->addField('notify_url', route('dash.paypal.ipn'));

        // Description of item. If you omit this variable, buyers enter their own name during checkout.
        // Optional for Buy Now, Donate, Subscribe, Automatic Billing, and Add to Cart buttons Character length: 127
        $this->paypal->addField('item_name', 'The Vacation Calendar Annual Subscription');

        // The locale of the checkout login or sign-up page. PayPal provides localized checkout pages
        // for some countries and languages.
        //
        // For more information about locale codes and a list of supported locales, see the PayPal
        // locale codes reference https://developer.paypal.com/api/rest/reference/locale-codes/ page.
        $this->paypal->addField('lc', 'US');

        // Trial period 1 price. For a free trial period, specify 0.
//        $this->paypal->addField('a1', '0');

        // Trial period 1 duration. Required if you specify a1. Specify an integer value in the valid range for
        // the units of duration that you specify with t1.
//        $this->paypal->addField('p1', '1');

        // Trial period 1 units of duration.
        // Valid value is:
        //      D. Days. Valid range for p1 is 1 to 90.
        //      W. Weeks. Valid range for p1 is 1 to 52.
        //      M. Months. Valid range for p1 is 1 to 24.
        //      Y. Years. Valid range for p1 is 1 to 5.
        // Character Length: 1
//        $this->paypal->addField('t1', $billed === 'monthly' ? 'M' : 'Y');

        // Regular subscription price.
        $this->paypal->addField('a3', User::PLANS[$plan][$billed]);

        // Desired currency on individual transactions
        // Use the currency_code variable on individual transactions to specify the currency of the payment:
        //
        // For allowable values in currency_code,
        // see Currencies Supported https://developer.paypal.com/api/nvp-soap/currency-codes/ by PayPal.
        // PayPal uses 3-character ISO-4217 codes for specifying currencies in fields and variables.
        //
        // Note: If the currency_code variable is not included, the currency defaults to USD.
        $this->paypal->addField('currency_code', 'USD');

        // Recurring payments. Subscription payments recur unless subscribers cancel their subscriptions
        // before the end of the current billing cycle, or you limit the number of times that payments
        // recur with the value that you specify for srt.
        // Valid value is:
        //      0. Subscription payments do not recur.
        //      1. Subscription payments recur.
        // Default is 0. Character Length: 1
        $this->paypal->addField('src', '1');

        // Subscription duration. Specify an integer value in the Valid range for the units of
        // duration that you specify with t3. Character Length: 2
        $this->paypal->addField('p3', '1');

        // Regular subscription units of duration.
        // Valid value is:
        //      D. Days. Valid range for p3 is 1 to 90.
        //      W. Weeks. Valid range for p3 is 1 to 52.
        //      M. Months. Valid range for p3 is 1 to 24.
        //      Y. Years. Valid range for p3 is 1 to 5.
        // Character Length: 1
        $this->paypal->addField('t3', $billed === 'monthly' ? 'M' : 'Y');

        // Reattempt on failure. If a recurring payment fails, PayPal attempts to collect the payment two more
        // times before canceling the subscription.
        // Valid value is:
        //      0. Do not reattempt failed recurring payments.
        //      1. Reattempt failed recurring payments before canceling.
        // Default is 1. Character Length: 1
        // For more information, see Reattempting Failed Recurring Payments with Subscribe Buttons.
        // https://developer.paypal.com/api/nvp-soap/paypal-payments-standard/integration-guide/html-example-subscribe#reattempted-payments
        $this->paypal->addField('sra', '1');

        // User-defined field which PayPal passes through the system and returns to you in your merchant payment
        // notification email. Subscribers do not see this field.
        // Character Length: 255
        $this->paypal->addField('custom', auth()->user()->HouseId);


        return $this->paypal->submitPaypal(); // submit the fields to paypal
    }

    /**
     * @return string
     */
    public function succeeded($plan, $billed, House $house)
    {
        $house->update(['Status' => 'A', 'plan' => $plan, 'billed' => $billed]);

        return redirect()->route('dash.plans-and-pricing')->with('status', "Thank you for your order! You have been successfully subscribed $plan plan");
    }

    public function canceled($plan, $billed, House $house)
    {
        $house->update(['Status' => 'C', 'plan' => null]);

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
    public function ipn()
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
