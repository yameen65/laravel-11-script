<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\Constants\Constants;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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
        $this->forceSchemeHttps();

        Gate::before(function ($user, $ability) {
            return $user->hasRole(Constants::SUPERADMIN, 'web') ? true : null;
        });

        Blade::component('auth.pages.users.profile.layout', 'my-profile');
        Blade::component('auth.pages.settings.layout', 'settings');

        Route::middleware('web', 'auth')
            ->prefix('my-account')
            ->group(base_path('routes/panel.php'));
    }

    public function forceSchemeHttps(): void
    {
        if ($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
