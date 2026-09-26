<?php

namespace App\Http\Services\OtpService;

use App\Contracts\OtpSender;
use App\Models\Notify\SMS;
use Exception;
use HttpException;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Support\Facades\Log;
use Kavenegar\KavenegarApi;
use File;


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

    public function sendNotification(string $to, string $message, ?string $subject = null, ?File $file = null): bool
    {
        try {
            $api = new KavenegarApi(
                config('app.kavenegar_api'),
                insecure: app()->isLocal()
            );

            $api->Send(
                config('app.kavenegar_number'),
                $to,
                $message,
            );
        } catch (HttpClientException | HttpException | Exception $e) {
            Log::error("SMS Notification Was Not Send: " , [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTrace(),
                'user' => $to,
                'sendMessage' => $message,
            ]);
            return false;
        }
        return true;
    }
}
