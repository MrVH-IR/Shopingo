<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Support\Facades\Log;

class InvalidOtpException extends Exception
{
    /**
     * @throws Exception
     */
    public function render()
    {
        Log::error("Invalid OTP" , ["message" => $this->getMessage()]);
        throw new Exception('Invalid OTP');
    }
}
