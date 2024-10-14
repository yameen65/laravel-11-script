<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use App\Constants\Constants;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Helper\Helpers;
use App\Repositories\SettingRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

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

            Route::middleware('web', 'auth')
                ->prefix('my-account')
                ->group(base_path('routes/panel.php'));

            $this->configSet();
        } else {
            dd('sdf');
        }
    }

    private function configSet(): void
    {
        if (Schema::hasTable('settings')) {
            $settingRepo = app(SettingRepository::class);
            $setting = $settingRepo->index();

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

                Auth::routes(
                    [
                        'verify' => true,
                        'login' => false,
                        'register' => false,
                        'logout' => false
                    ]
                );
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
            \URL::forceScheme('https');
        }
    }
}
