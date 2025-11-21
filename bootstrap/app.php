<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [__DIR__.'/../routes/web.php' , '../common/routes/web.php'],
    //    api: [__DIR__.'/../routes/api.php'],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        // then: function() {
        //     app('router')->middleware('web')->
        //     prefix('admin')->
        //     group(base_path('common/routes/web.php'));
        // }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append([\App\Http\Middleware\Common\BlockedUsersMiddleware::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
