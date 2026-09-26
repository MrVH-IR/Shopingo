<?php

namespace App\Providers;

use App\Models\Content\Comment;
use App\Models\Notification;
use App\Models\Notify\Email;
use App\Models\Notify\SMS;
use App\Observers\Admin\EmailObserver;
use App\Observers\Admin\SmsObserver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom([base_path('common' . DIRECTORY_SEPARATOR . 'migrations')]);
        Route::middleware(['web'])
            ->group(base_path('/common/routes/web.php'));
        View::composer('admin.layouts.header', function ($view) {
            $view->with('unSeenComment' , Comment::where('seen' , 0)->get());
            $view->with('notifications' , Notification::where('read_at' , null)->get());
        });
        Email::observe(EmailObserver::class);
        SMS::observe(SMSObserver::class);
    }
}
