<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::get('/', function (){
//    return view('frontend.index');
//})->name('index');


Auth::routes();
//Auth::routes(['register' => false]);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::get('/', [App\Http\Controllers\Frontend\FrontendController::class, 'index'])->name('index');

// These Routes are accessible after login
Route::middleware('auth')->group(function () {

    // Add Prefix on route name and route url
    Route::prefix('backend')->name('backend.')->group(function () {

        // These Routes are only accessible by admin
        Route::group(['middleware' => ['role:admin']], function () {
            // User Routes
            Route::resource('user', App\Http\Controllers\Backend\UserController::class);
//            Route::get('/user/search', [App\Http\Controllers\Backend\UserController::class, 'search'])->name('user.search');
            // Permission Routes
            Route::resource('permission', App\Http\Controllers\Backend\PermissionController::class);
            // Role Routes
            Route::resource('role', App\Http\Controllers\Backend\RoleController::class);

            // Setting Trash Routes
            Route::get('/setting/trash', [App\Http\Controllers\Backend\SettingController::class, 'trash'])->name('setting.trash');
            Route::get('/setting/{setting}/restore', [App\Http\Controllers\Backend\SettingController::class, 'restore'])->name('setting.restore');
            Route::delete('setting/{setting}/remove', [App\Http\Controllers\Backend\SettingController::class, 'remove'])->name('setting.remove');

            // Category Trash Routes
            Route::get('/category/trash', [App\Http\Controllers\Backend\CategoryController::class, 'trash'])->name('category.trash');
            Route::get('/category/{category}/restore', [App\Http\Controllers\Backend\CategoryController::class, 'restore'])->name('category.restore');
            Route::delete('/category/{category}/remove', [App\Http\Controllers\Backend\CategoryController::class, 'remove'])->name('category.remove');

        });

        // Setting Routes
        Route::group(['middleware' => ['permission:manage-setting']], function () {
            Route::resource('setting', App\Http\Controllers\Backend\SettingController::class);
        });
        // Category Routes
        Route::group(['middleware' => ['permission:manage-category']], function () {
            Route::resource('category', App\Http\Controllers\Backend\CategoryController::class);
        });
        // State, District, and City Routes
        Route::group(['middleware' => ['permission:manage-location']], function () {
            Route::resource('state', App\Http\Controllers\Backend\StateController::class);
            Route::resource('district', App\Http\Controllers\Backend\DistrictController::class);
            Route::resource('city', App\Http\Controllers\Backend\CityController::class);
        });
    });
});
