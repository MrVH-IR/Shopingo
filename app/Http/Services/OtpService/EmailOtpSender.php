<?php

namespace App\Http\Services\OtpService;

use App\Contracts\OtpSender;
use App\Mail\Customer\Auth\LoginCode;
use Exception;
use File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Admin\NotificationMail;

class EmailOtpSender implements OtpSender {

    public function send(string $to, string $code): void
    {
        Mail::to($to)->queue(new LoginCode($to, $code));
    }

    public function sendNotification(
        string $to,
        string $message,
        ?string $subject = null,
        ?File $file = null
    ): bool
    {
        try {
            Mail::to($to)->queue(
                new NotificationMail(
                    subject: $subject ?? config('app.app_persian_name'),
                    body: $message,
                    file: $file
                )
            );

            return true;
        } catch (Exception $e) {
            Log::error('Email Notification Was Not Send', [
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
                'user' => $to,
            ]);

            return false;
        }
    }
}
