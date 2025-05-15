<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\StoreController;
use App\Http\Controllers\Dashboard\CatalogController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){
        Livewire::setScriptRoute(function($handle) {
            return Route::get('/path/livewire/livewire.js', $handle);
        });
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });
        ################################ Auth Routes #################################
        Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        ################################ End Auth Routes #############################


        Route::prefix('password')->as('password.')->group(function () {
            ################################ Forget Password Routes #################################
            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('email');
                Route::post('email', 'sendCode')->name('sendCode');
                Route::get('verify/{email}', 'showCodeForm')->name('showCodeForm');
                Route::post('verify', 'verifyCode')->name('verifyCode');
            });
            ################################ End Forget Password Routes ############################

            ################################ Reset Password Routes #################################
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}', 'showResetForm')->name('showResetForm');
                Route::post('reset', 'resetPassword')->name('reset');
            });
            ################################ End Reset Password Routes #############################
        });


        ################################ Protected Admin Routes #################################
        Route::group(['middleware' => 'auth:admin'], function () {

            ################################ Home Routes #################################
            Route::get('home', [HomeController::class, 'index'])->name('home');
            ################################ End Home Routes #################################

            ################################ Admins Routes #################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins', AdminController::class);
                Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])->name('admins.changeStatus');
            });
            ################################ End Admins Routes #############################

            ################################ Roles Routes #################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RoleController::class);
            });
            ################################ End Roles Routes #############################

            ################################ Users Routes #################################
            Route::group(['middleware' => 'can:users'], function () {
                Route::resource('users', UserController::class);
                Route::get('users/{id}/status', [UserController::class, 'changeStatus'])->name('users.changeStatus');
                Route::get('users-all', [UserController::class, 'getAllUsers'])->name('users.all');
            });
            ################################ End Users Routes #############################

            ################################ Store Routes #################################
            Route::group(['middleware'=>'can:stores'], function() {
                Route::resource('stores', StoreController::class)->except('show');
                Route::get('stores-all', [StoreController::class, 'getAllstores'])->name('stores.all');
                Route::get('stores/{id}/status', [StoreController::class, 'changeStatus'])->name('stores.changeStatus');
            });
            ################################ End Store Routes #################################


           ################################ Catalogs Routes #################################
           Route::group([], function() {
                Route::get('stores/{store}/catalogs/create', [CatalogController::class, 'create'])->name('catalogs.create');
                Route::get('catalogs', [CatalogController::class, 'index'])->name('catalogs.index');
                Route::post('catalogs', [CatalogController::class, 'store'])->name('catalogs.store');
                Route::get('catalogs-all', [CatalogController::class, 'getAllCatalogs'])->name('catalogs.all');
                Route::get('catalogs-all/{store_id}', [CatalogController::class, 'getStoreCatalogs'])->name('catalogs.getStoreCatalogs');
                Route::get('catalogs/{id}/edit', [CatalogController::class, 'edit'])->name('catalogs.edit');
                Route::put('catalogs/{id}', [CatalogController::class, 'update'])->name('catalogs.update');
                Route::delete('catalogs/{id}', [CatalogController::class, 'destroy'])->name('catalogs.destroy');
                Route::get('catalogs/{id}/status', [CatalogController::class, 'changeStatus'])->name('catalogs.changeStatus');
            });
           ################################ End Catalog Routes #################################

            ################################ Setting Routes #################################
            Route::group(['middleware'=>'can:settings', 'as' => 'settings.'],  function() {
                Route::get('settings', [SettingController::class, 'index'])->name('index');
                Route::put('settings/{id}', [SettingController::class, 'update'])->name('update');
            });
            ################################ End Setting Routes #################################

        });
    });
