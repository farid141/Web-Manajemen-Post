<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //menggunakan bootstrap untuk pagination
        Paginator::useBootstrap();

        // gate admin hanya dapat diakses username faridnubaili
        Gate::define('admin', function (User $user) {
            return $user->is_admin;
        });
    }
}
