<?php

namespace App\Http\Controllers\AppControllers;

use App\Http\Controllers\Controller;
use App\Models\ProcessingSubscription;
use App\Models\Room\Room;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Facades\PayPal;

class PaypalController extends BaseController
{

    public $paypal;
    public $price = 0;

    public function __construct()
    {
        $this->paypal = PayPal::setProvider();
        $this->paypal->getAccessToken();
    }


    /**
     * Get Plans aAnd Pricing api
     *
     * @return \Illuminate\Http\Response
     */
    public function planAndPricing(Request $request)
    {
        try {
            $user = Auth::user();
            $subscription = Subscription::where([
                'user_id' => $user->user_id,
                'house_id' => $user->HouseId
            ])->whereNotIn('status', ['CANCELLED','IN_PROCESS','COMPLETED','APPROVED'])->latest()->first();

            $response = [
                'success' => true,
                'data' => [
                    'subscription' => $subscription,
                ],
                'message' => 'Data fetched successfully',
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            Log::channel('paypal')->error('Current Subscription: ', [$e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


    /**
     * Process Subscription api
     *
     * @return \Illuminate\Http\Response
     */
    public function processSubscription(Request $request)
    {
        $user = Auth::user();
        $plan = $request->plan;
        $billed = $request->billed;
        $mode = config('paypal.mode');

        abort_if(
            !array_key_exists($plan, config("paypal.$mode.plans")) || !in_array($billed, ['monthly', 'yearly']),
            404
        );

        try {
            $checkSubscription = Subscription::where('user_id', $user->user_id)->latest()->first();
            if (!is_null($checkSubscription)){
                $checkPaypalSubscription = $this->paypal->showSubscriptionDetails($checkSubscription->subscription_id);
                if ($checkPaypalSubscription['status'] === 'APPROVAL_PENDING'){
                    $processingSubscription = ProcessingSubscription::where([
                        'subscription_id' => $checkSubscription->id,
                        'status' => 'APPROVAL_PENDING'
                    ])->first();
                    if (!is_null($processingSubscription) && $processingSubscription->plan === $plan && $processingSubscription->period === $billed) {
                        $redirectTo = null;
                        foreach ($checkPaypalSubscription['links'] ?? [] as $link) {
                            if ($link['rel'] === 'approve') {
                                $redirectTo = $link['href'];
                            }
                        }
                        if (!is_null($redirectTo)) {
                            return response()->json([
                                'success' => true,
                                'data' => [
                                    'redirect_url' => $redirectTo
                                ],
                            ]);
                        }
                    } else {
                        $processingSubscription->delete();
                        $processingSubscription->subscription->delete();
                    }
                }
            }



            $paypalSubscription = $this->paypal->createSubscription([
                'plan_id' => config("paypal.$mode.plans.$plan.$billed")
            ]);

            if (isset($paypalSubscription['error'])) {
                Log::channel('paypal')->error('Create Subscription: ', [$paypalSubscription['error']]);
            } else {
                $subscription = Subscription::create([
                    'user_id' => $user->user_id,
                    'house_id' => $user->HouseId,
                    'subscription_id' => $paypalSubscription['id'],
                    'plan_id' => config("paypal.$mode.plans.$plan.$billed"),
                    'plan' => $plan,
                    'period' => $billed,
                    'status' => 'IN_PROCESS',
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


                ProcessingSubscription::create([
                    'subscription_id' => $subscription['id'],
                    'plan_id' => config("paypal.$mode.plans.$plan.$billed"),
                    'plan' => $plan,
                    'period' => $billed,
                    'status' => $paypalSubscription['status'],
                ]);

                $redirectTo = null;
                foreach ($paypalSubscription['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        $redirectTo = $link['href'];
                    }
                }

                if ($redirectTo) {
                    return response()->json([
                        'success' => true,
                        'data' => [
                            'redirect_url' => $redirectTo
                        ],
                    ]);
                }
            }
        } catch (\Exception $e) {
            Log::channel('paypal')->error('Create Subscription: ', [$e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }

        return response()->json([
            'success' => false,
            'message' => 'A PayPal subscription is already in process. Please complete the approval process or reset your subscription.',
        ]);
    }


    /**
     * Cancel Subscription api
     *
     * @return \Illuminate\Http\Response
     */
    public function canceledSubscription()
    {
        try {
            $user = Auth::user();
            $paypalSubscription = Subscription::where([
                'user_id' => $user->user_id,
                'status' => 'ACTIVE'
            ])->latest()->first();

            ProcessingSubscription::create([
                'subscription_id' => $paypalSubscription->id,
                'plan_id' => $paypalSubscription->plan_id,
                'plan' => $paypalSubscription->plan,
                'period' => $paypalSubscription->period,
                'status' => 'APPROVAL_PENDING',
            ]);
            $subscription = Subscription::where([
                'user_id' => $user->user_id,
                'house_id' => $user->HouseId
            ])->whereNotIn('status', ['CANCELLED','IN_PROCESS','COMPLETED','APPROVED'])->latest()->first();

            $subscription->cancel();

            $response = [
                'success' => true,
                'message' => 'You have been unsubscribed successfully. You may see the status is not changed as soon as verified from paypal it will update automatically.'
            ];
            return response()->json($response, 200);

        } catch (\Exception $e) {
            Log::channel('paypal')->error('Cancel Subscription: ', [$e->getMessage()]);
            return $this->sendError($e->getMessage(), []);
        }
    }


}
