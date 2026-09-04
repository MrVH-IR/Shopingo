<?php

namespace Common\Services\Exception;

use Exception;
use Illuminate\Support\Facades\Log;

class OutOfStockException extends Exception
{

    /**
     * @throws Exception
     */
    public function render()
    {
        Log::error("Out Of Stock", ["message" => $this->getMessage()]);
        throw new Exception('Out Of Stock');
    }
}
