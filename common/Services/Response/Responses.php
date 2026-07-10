<?php

namespace Common\Services\Response;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Route;

class Responses
{

    public static function redirectToWith(
        string $route,
        string $type,
        string $status,
        string $message,
    ): RedirectResponse {
        return redirect()
            ->route($route)
            ->with([
                "bootstrap-{$type}" => [
                    'status' => $status,
                    'message' => $message,
                ]
            ]);
    }

    public static function redirectToWithBack(
        string $type,
        string $status,
        string $message,
    ): RedirectResponse {
        return redirect()
            ->back()
            ->with([
                "bootstrap-{$type}" => [
                    'status' => $status,
                    'message' => $message,
                ]
            ]);
    }
}
