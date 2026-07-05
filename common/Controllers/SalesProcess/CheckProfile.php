<?php

namespace Common\Controllers\SalesProcess;

use App\Models\Market\CartItem;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckProfile
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
                $user->email,
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
        } elseif (
            CartItem::query()->where('user_id', $user->id)->count() === 0
        ) {
            return redirect()->route('customer.home')->withErrors([
                'message' => 'سبد خرید شما خالی می باشد'
            ]);
        }
        return $next($request);
    }
}
