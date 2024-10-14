<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Inaam\Installer\Middleware\ApplicationStatus;

// Route::middleware(ApplicationStatus::class)->group(function () {
// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
// });

Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    Artisan::call('migrate:fresh --seed');
    return "Cleared";
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::prefix('/account/')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('signin', 'showLoginForm')->name('login');
        Route::post('signin', 'login');
    });

    Route::controller(RegisterController::class)->group(function () {
        Route::get('signup', 'showRegistrationForm')->name('register');
        Route::post('signup', 'register');
    });

    Route::get('verify', function () {
        return view('auth.verify');
    })->name('verify_email')->middleware('CheckVerifiedAccount');
});
