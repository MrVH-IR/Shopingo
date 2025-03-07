<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
                // اگر کاربر لاگین نکرده، به صفحه ورود برود
                if (!Auth::check()) {
                    return redirect()->route('login')->with('error', 'لطفاً وارد حساب کاربری شوید.');
                }

                // بررسی مسیر
                $isAdminRoute = $request->is('admin/*');

                // اگر کاربر ادمین است و به مسیر `/admin/*` می‌رود، اجازه بدهد
                if (Auth::user()->role === 'admin' && $isAdminRoute) {
                    return $next($request);
                }

                // اگر کاربر معمولی است و به مسیر `/admin/*` می‌رود، او را به `/dashboard` بفرست
                if (Auth::user()->role !== 'admin' && $isAdminRoute) {
                    return redirect()->route('dashboard')->with('error', 'شما اجازه دسترسی به این بخش را ندارید.');
                }

                // اگر مسیر `/dashboard` است، بررسی کند که آیا کاربر ادمین است یا نه
                if ($request->is('dashboard')) {
                    if (Auth::user()->role === 'admin') {
                        return redirect()->route('admin.dashboard');
                    } else {
                        return $next($request); // نمایش داشبورد کاربران عادی
                    }
                }

                return $next($request);
    }
}
