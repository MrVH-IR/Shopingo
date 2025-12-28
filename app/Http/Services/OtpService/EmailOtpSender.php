<?php

namespace App\Http\Services\OtpService;

use App\Contracts\OtpSender;
use App\Mail\Customer\Auth\LoginCode;
use Illuminate\Support\Facades\Mail;

class EmailOtpSender implements OtpSender {

    public function send(string $to, string $code): void
    {
        Mail::to($to)->queue(new LoginCode($to, $code));
    }
}
