<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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

                Route::get('privacy-safety', [UserController::class, 'safety_privacy'])->name('safety_privacy');

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

                // Roles routes
                Route::prefix('roles')->as('roles.')->controller(RoleController::class)->group(function () {
                    Route::get('', 'index')->name('index')->middleware('can:all_role');
                    // Route::get('create', 'create')->name('create')->middleware('can:add_role');
                    // Route::post('store', 'store')->name('store')->middleware('can:add_role');
                    Route::get('show/{role}', 'show')->name('show')->middleware('can:view_role');
                    Route::get('edit/{role}', 'edit')->name('edit')->middleware('can:edit_role');
                    Route::put('update/{role}', 'update')->name('update')->middleware('can:edit_role');
                    Route::delete('delete/{role}', 'delete')->name('destroy')->middleware('can:delete_role');
                });

                // Permission routes
                Route::prefix('permissions')->as('permissions.')->controller(PermissionController::class)->group(function () {
                    Route::get('', 'index')->name('index')->middleware('can:all_permission');
                    // Route::get('create', 'create')->name('create')->middleware('can:add_permission');
                    // Route::post('store', 'store')->name('store')->middleware('can:add_permission');
                    Route::get('show/{permission}', 'show')->name('show')->middleware('can:view_permission');
                    Route::get('edit/{permission}', 'edit')->name('edit')->middleware('can:edit_permission');
                    Route::put('update/{permission}', 'update')->name('update')->middleware('can:edit_permission');
                    Route::delete('delete/{permission}', 'delete')->name('destroy')->middleware('can:delete_permission');

                    Route::get('assign/{roleId}', 'assign_permission')->name('assign')->middleware('can:assign_permission');
                    Route::put('assign/{roleId}', 'assign_permission_store')->name('give')->middleware('can:assign_permission');
                });
            }
        );
    }
);
