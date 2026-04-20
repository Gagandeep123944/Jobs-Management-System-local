<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});



Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/loginsave', 'loginsave')->name('loginsave');
    Route::post('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/forgetpassword', 'forgetpassword')->name('forgetpassword');
});

