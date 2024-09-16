<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true, 'login' => false, 'register' => false, 'logout' => false]);

Route::group(
    ['prefix' => "my-account", "middleware" => ["auth"]],
    function () {
        Route::get('/logout', [HomeController::class, 'logout'])->name('logout');

        Route::group(
            ['middleware' => 'checkMail'],
            function () {
                Route::get('/', [HomeController::class, 'index'])->name('auth');

                Route::get('profile', [UserController::class, 'editprofile'])->name('myprofile');
                Route::put('edit-my-profile', [UserController::class, 'updatemyprofile'])->name('updatemyprofile');

                Route::get('password-change', [ResetPasswordController::class, 'changePassword'])->name('change_password');
                Route::post('change-password/update', [ResetPasswordController::class, 'updatePassword'])->name('update_password');

                Route::prefix('users')->as('users.')->controller(UserController::class)->middleware(['isAdmin'])->group(function () {
                    Route::get('', 'index')->name('index')->middleware('can:all_user');
                    Route::get('create', 'create')->name('create')->middleware('can:add_user');
                    Route::get('show/{user}', 'show')->name('show')->middleware('can:view_user');
                    Route::post('store', 'store')->name('store')->middleware('can:add_user');
                    Route::get('edit/{user}', 'edit')->name('edit')->middleware('can:edit_user');
                    Route::put('update/{user}', 'update')->name('update')->middleware('can:edit_user');
                    Route::delete('delete/{user}', 'delete')->name('destroy')->middleware('can:delete_user');
                });
            }
        );
    }
);
