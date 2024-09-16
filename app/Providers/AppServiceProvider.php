<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\Constants\Constants;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Constants::SUPERADMIN, 'web') ? true : null;
        });

        Blade::component('auth.pages.users.profile.layout', 'my-profile');
    }
}
