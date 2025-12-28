<?php

namespace App\Http\Services\OtpService;


use App\Http\Services\OtpService\EmailOtpSender;
use App\Http\Services\OtpService\SmsOtpSender;
use http\Exception\InvalidArgumentException;

class OtpSenderFactory {

    public static function make(int $type) {
        return match ($type) {
            0 => app(SmsOtpSender::class),
            1 => app(EmailOtpSender::class),
            default => throw new InvalidArgumentException('Invalid OTP type'),
        };
    }
}
