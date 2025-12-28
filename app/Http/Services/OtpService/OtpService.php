<?php

namespace App\Http\Services\OtpService;

use Common\Models\Otp;
use Illuminate\Support\Str;

class OtpService {

    public function generateAndSave(string $identify , int $userID , $type): void
    {
        $code = rand(1111111 , 999999);
        $token = Str::random(64);
        Otp::create([
            'token' => $token,
            'user_id' => $userID,
            'otp_code' => $code,
            'login_id' => $identify,
            'type' => $type
        ]);
        $sender = OtpSenderFactory::make($type);
        $sender->send($identify , (string) $code);
    }
}
