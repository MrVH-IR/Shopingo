<?php

namespace App\Http\Middleware\Common;

use Closure;
use Common\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class BlockFloodRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        $key = "requests:{$ip}";

        if (RateLimiter::tooManyAttempts($key, 7000)) {
            BlockedUser::on('sqlite')->create([
                'ip_address' => $ip,
                'mac_address' => $request->get('mac_address'),
                'user_id' => $request->get('user_id'),
            ]);

            return response()->noContent();
        }

        RateLimiter::hit($key);

        return $next($request);
    }
}
