<?php

namespace App\Http\Services\OtpService;

use App\Contracts\OtpSender;
use Kavenegar\KavenegarApi;

class SmsOtpSender implements OtpSender {

    public function send(string $to , string $code): void
    {
        $message = "کد ورود ".config('app.name').": ".$code."\n"
            . "اعتبار: ۲ دقیقه\n"
            . "اگر شما درخواست نداده‌اید، پیام را نادیده بگیرید.";

        $api = new KavenegarApi(
            config('app.kavenegar_api'),
            insecure: app()->isLocal()
        );

        $api->Send(
            config('app.kavenegar_number'),
            $to,
            $message
        );
    }
}
