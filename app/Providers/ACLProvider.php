<?php

namespace App\Providers;

use App\Models\User;
use App\Models\User\Permission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        $tables = Schema::getTables();
        if (empty($tables)) {
            return;
        }
        $permissions = Cache::remember('permissions', now()->addHours(3), function () {
            return Permission::where('status', 1)->get();
        });
        $permissions->each(function ($permission) {
            Gate::define($permission->name, function (User $user) use ($permission) {
                return $user->hasPermission($permission->name);
            });
        });
    }
}
