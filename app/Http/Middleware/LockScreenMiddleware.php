<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LockScreenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (
            auth()->check() &&
            $request->path('admin') &&
            session('screen_locked', false) &&
            ! $request->routeIs('lock-screen.*')
        ) {
            return redirect()->route('lock-screen.show');
        }

        return $next($request);
    }
}
