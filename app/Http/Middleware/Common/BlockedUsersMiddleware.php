<?php

namespace App\Http\Middleware\Common;

use Closure;
use Common\Models\BlockedUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BlockedUsersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $blockedIps = Cache::remember('blocked_ips', 30, function () {
            return BlockedUser::on("sqlite")->pluck('ip_address')->toArray();
        });

        if (in_array($ip , $blockedIps , true)) {
            abort(Response::HTTP_FORBIDDEN , "You are not allowed to access this page. Contact Admin If You Think This is Wrong");
        }
        return $next($request);
    }
}
