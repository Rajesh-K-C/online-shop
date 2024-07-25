<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function (){
    return view('frontend.index');
})->name('index');


Auth::routes();
//Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
