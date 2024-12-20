<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

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

        Route::prefix('roles')->as('roles.')->controller(RoleController::class)->group(function () {
            Route::get('', 'index')->name('index')->middleware('can:all_role');
            Route::post('store', 'store')->name('store')->middleware('can:add_role');
            Route::put('update/{role}', 'update')->name('update')->middleware('can:edit_role');
            Route::delete('delete/{role}', 'destroy')->name('destroy')->middleware('can:delete_role');

            Route::post('assign/permission', 'assign_permission')->name('assign_permission')->middleware('can:assign_permission');
        });

        Route::prefix('s')->as('settings.')->middleware('can:site_setting')->controller(SettingController::class)->group(function () {

            Route::get('{blade}', 'index')->name('index');

            Route::put('basic_info/update', 'basic_info')->name('basic_info');
            Route::put('smtp/update', 'smtp_update')->name('smtp_update');
            Route::put('social-logins/update', 'social_logins_update')->name('social_logins_update');
            Route::put('registration/update', 'registeration_update')->name('registeration_update');
            Route::post('clear-cache', 'clear_cache')->name('clear_cache');

            Route::post('update/default-language', 'update_default_language')->name('update_default_language');
            Route::post('install/language', 'install_language')->name('install_language');
            Route::post('active/language', 'active_language')->name('active_language');
        });
    }
);

Route::prefix('post')->as('posts.')->middleware('auth')->group(function () {
    Route::get('create', [PostController::class, 'create'])->name('create');
    Route::get('index', [PostController::class, 'index'])->name('index');
    Route::post('store', [PostController::class, 'store'])->name('store');
    Route::get('show/{id}', [PostController::class, 'show'])->name('show');
    Route::get('edit/{id}', [PostController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [PostController::class, 'update'])->name('update'); 
    Route::delete('delete/{id}', [PostController::class, 'destroy'])->name('delete'); 
});




Route::prefix('comment')->as('comments.')->middleware('auth')->group(function () {
    Route::post('store', [CommentController::class, 'store'])->name('store');
});

Route::post('/ratings', [RatingController::class, 'store'])->name('ratings.store');