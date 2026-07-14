<?php

namespace App\Providers;

use App\Models\User;
use App\Models\User\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class ACLProvider extends ServiceProvider
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
        Permission::query()
            ->where('status', 1)
            ->get()
            ->each(function ($permission) {

                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermission($permission->name);
                });

            });
    }
}
