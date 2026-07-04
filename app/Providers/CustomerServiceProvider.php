<?php

namespace App\Providers;

use App\Models\Market\CartItem;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('customer.layouts.header', function ($view) {
           $view->with('cartItems', CartItem::where('user_id', auth()->id())->get());
        });
    }
}
