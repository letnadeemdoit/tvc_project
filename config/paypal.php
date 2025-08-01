<?php
/**
 * PayPal Setting & API Credentials
 * Created by Raza Mehdi <srmk@outlook.com>.
 */

return [
    'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
        'app_id'            => 'APP-80W284485P519543T',
        'plans' => [
            'basic' => [
                'monthly'   => env('PAYPAL_SANDBOX_BASIC_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_SANDBOX_BASIC_YEARLY_PLAN_ID', ''),
            ],
            'standard' => [
                'monthly'   => env('PAYPAL_SANDBOX_STANDARD_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_SANDBOX_STANDARD_YEARLY_PLAN_ID', ''),
            ],
            'premium' => [
                'monthly'   => env('PAYPAL_SANDBOX_PREMIUM_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_SANDBOX_PREMIUM_YEARLY_PLAN_ID', ''),
            ],
        ]
    ],
    'live' => [
        'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
        'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
        'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
        'plans' => [
            'basic' => [
                'monthly'   => env('PAYPAL_LIVE_BASIC_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_LIVE_BASIC_YEARLY_PLAN_ID', ''),
            ],
            'standard' => [
                'monthly'   => env('PAYPAL_LIVE_STANDARD_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_LIVE_STANDARD_YEARLY_PLAN_ID', ''),
            ],
            'premium' => [
                'monthly'   => env('PAYPAL_LIVE_PREMIUM_MONTHLY_PLAN_ID', ''),
                'yearly'    => env('PAYPAL_LIVE_PREMIUM_YEARLY_PLAN_ID', ''),
            ],
        ]
    ],

    'payment_action' => env('PAYPAL_PAYMENT_ACTION', 'Sale'), // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'       => env('PAYPAL_CURRENCY', 'USD'),
    'notify_url'     => env('PAYPAL_NOTIFY_URL', ''), // Change this accordingly for your application.
    'locale'         => env('PAYPAL_LOCALE', 'en_US'), // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
    'validate_ssl'   => env('PAYPAL_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
