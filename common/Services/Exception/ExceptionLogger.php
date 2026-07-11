<?php

namespace Common\Services\Exception;

use Illuminate\Support\Facades\Log;
use Throwable;

class ExceptionLogger
{
    public static function error(Throwable $e, string $message): string
    {
        $errorId = now()->format('YmdHis') . random_int(1000, 9999);

        Log::error($message, [
            'error_id' => $errorId,
            'message'  => $e->getMessage(),
            'code'     => $e->getCode(),
            'file'     => $e->getFile(),
            'line'     => $e->getLine(),
            'trace'    => $e->getTraceAsString(),
        ]);

        return $errorId;
    }
}
