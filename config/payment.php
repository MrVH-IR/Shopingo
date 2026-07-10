<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Zarinpal Setting
    |--------------------------------------------------------------------------
    | These options here allow the application to communicate with
    | Zarinpal Payment Gateway.
    | Specified when running an Payment operation with Zarinpal.
    |
    */
    'zarinpal' => [
        'merchantId' => env('ZARINPAL_MERCHANT_ID'),
        'sandbox' => env('ZARINPAL_SANDBOX', false),
        'zarinpalGateway' => 'https://payment.zarinpal.com/pg/v4/payment/request.json',
        'verifyGateway' => 'https://payment.zarinpal.com/pg/v4/payment/verify.json',
        'gateway' => 'https://payment.zarinpal.com/pg/StartPay',
        'sandboxGateway' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
        'sandboxVerifyGateway' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',
        'sandboxGate' => 'https://sandbox.zarinpal.com/pg/StartPay',
        'referrer_id' => '',
        "currency" => "T",
    ],

];
