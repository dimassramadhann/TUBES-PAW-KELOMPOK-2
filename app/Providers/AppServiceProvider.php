<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        // Gate 'admin' untuk pengecekan role di Route & Blade: can('admin')
        Gate::define('admin', function (User $user): bool {
            return strtolower((string) $user->role) === 'admin';
        });
    }
}
