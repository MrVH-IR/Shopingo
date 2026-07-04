<?php

namespace Common\Controllers\SalesProcess\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        if (
            collect([
                $user->mobile,
                $user->national_code,
                $user->first_name,
                $user->last_name,
            ])->contains(fn ($value) => blank($value))
        ) {
            return redirect()
                ->route('customer.sales-process.profile-complete')
                ->withErrors([
                    'message' => 'لطفاً پروفایل کاربری خود را تکمیل کنید.',
                ]);
        }
        return $next($request);
    }
}
