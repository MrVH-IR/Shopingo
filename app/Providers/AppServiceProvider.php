<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Notification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        $this->loadMigrationsFrom([base_path('common' . DIRECTORY_SEPARATOR . 'migrations')]);
        Route::middleware('web')
            ->prefix('admin')
            ->group(base_path('common/routes/web.php'));
        View::composer('admin.layouts.header', function ($view) {
            $view->with('unSeenComment' , Comment::where('seen' , 0)->get());
            $view->with('notifications' , Notification::where('read_at' , null)->get());
        });
    }
}
