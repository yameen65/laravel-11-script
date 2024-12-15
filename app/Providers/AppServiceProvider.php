<?php

namespace App\Providers;

use URL;
use App\Helper\Helpers;
use App\Constants\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Repositories\SettingRepository;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $dbConnectionStatus = Helpers::dbConnectionStatus();

        if ($dbConnectionStatus) {
            $this->forceSchemeHttps();

            Gate::before(function ($user, $ability) {
                return $user->hasRole(Constants::SUPERADMIN, 'web') ? true : null;
            });

            Blade::component('auth.pages.users.profile.layout', 'my-profile');
            Blade::component('auth.pages.settings.layout', 'settings');

            Route::middleware(
                'web',
                'auth',
                'localeSessionRedirect',
                'localizationRedirect',
                'localeViewPath',
            )
                ->prefix(LaravelLocalization::setLocale() . '/my-account')
                ->group(base_path('routes/panel.php'));

            $this->configSet();
        } else {
            abort(500, 'Database connection failed');
        }
    }

    private function configSet(): void
    {
        if (Schema::hasTable('settings')) {
            $settingRepo = app(SettingRepository::class);
            $setting = $settingRepo->index();

            $this->shareSetting($setting);

            $this->setLocale($setting->default_language);

            $siteConfig = $this->app['config'];

            if ($setting) {
                $siteConfig->set('app.name', $setting->name);
                $siteConfig->set('app.url', $setting->url);
                $siteConfig->set('app.logo', $setting->logo());

                $siteConfig->set('mail.mailers.smtp.host', $setting->smtp_host ?? env('MAIL_PORT'));
                $siteConfig->set('mail.mailers.smtp.port', (int)($setting->smtp_port ?? env('MAIL_PORT')));
                $siteConfig->set('mail.mailers.smtp.username', $setting->smtp_username ?? env('MAIL_USERNAME'));
                $siteConfig->set('mail.mailers.smtp.password', $setting->smtp_password ?? env('MAIL_PASSWORD'));
                $siteConfig->set('mail.mailers.smtp.encryption', $setting->smtp_encryption ?? env('MAIL_ENCRYPTION'));
                $siteConfig->set('mail.from.address', $setting->smtp_email ?? env('MAIL_FROM_ADDRESS'));
                $siteConfig->set('mail.from.name', $setting->smtp_sender_name ?? env('MAIL_FROM_NAME'));
            } else {
                abort(500, 'No settings found.');
            }
        } else {
            abort(500, 'The "setting" table does not exist.');
        }
    }

    private function forceSchemeHttps(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }

    private function shareSetting($setting): void
    {
        if ($setting) {
            View::share('setting', $setting);
        } else {
            abort(500, 'No settings found.');
        }
    }

    private function setLocale($lang): void
    {
        app()->setLocale($lang);
    }
}
