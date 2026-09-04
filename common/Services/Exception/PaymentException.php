<?php

namespace Common\Services\Exception;

use Exception;
use Illuminate\Support\Facades\Log;

class PaymentException extends Exception
{

    /**
     * @throws Exception
     */
    public function render()
    {
        Log::error("Payment Exception", ["message" => $this->getMessage()]);
        throw new Exception("Payment Exception: " . $this->getMessage());
    }

}
