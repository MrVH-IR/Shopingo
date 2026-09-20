<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\Common\BlockedUsersMiddleware;
use App\Http\Middleware\Common\BlockFloodRequests;
use App\Http\Middleware\LockScreenMiddleware;
use App\Http\Middleware\VerifyTurnstile;
use Common\Services\SalesProcess\Middleware\CheckProfile;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [__DIR__.'/../routes/web.php'],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([
            BlockedUsersMiddleware::class,
            BlockFloodRequests::class
        ]);
        $middleware->alias([
            'profile-complete' => CheckProfile::class,
            'admin' => AdminMiddleware::class,
            'lock-screen' => LockScreenMiddleware::class,
            'turnstile' => VerifyTurnstile::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
