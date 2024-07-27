<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('frontend.index');
})->name('index');


Auth::routes();
//Auth::routes(['register' => false]);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');
//Route::get('/user/list', [App\Http\Controllers\UserController::class, 'index'])->name('backend.user.list');
//Route::get('/user/search', [App\Http\Controllers\UserController::class, 'search'])->name('backend.user.search');
//Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('backend.user.show');

Route::prefix('backend')->name('backend.')->group(function () {
//    Route::resource('user',App\Http\Controllers\Backend\UserController::class);
    Route::get('/user', [App\Http\Controllers\Backend\UserController::class, 'index'])->name('user.index');
    Route::get('/user/{id}', [App\Http\Controllers\Backend\UserController::class, 'show'])->name('user.show');
    Route::put('/user/{id}', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('user.update');
    Route::get('/user/search', [App\Http\Controllers\Backend\UserController::class, 'search'])->name('user.search');
//    Route::get('/user/{id}/edit', [App\Http\Controllers\Backend\UserController::class, 'edit'])->name('backend.user.edit');

    Route::resource('setting', App\Http\Controllers\Backend\SettingController::class);

    Route::resource('category', App\Http\Controllers\Backend\CategoryController::class);
});
