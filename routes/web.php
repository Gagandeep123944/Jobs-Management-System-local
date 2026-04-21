<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;


Route::get('/', function () {
    return view('welcome');
});



Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/loginsave', 'loginsave')->name('loginsave');
    Route::post('/signsave', 'signsave')->name('signsave');
    Route::get('/forget/password', 'forgotPassword')->name('forgotPassword');
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/forget/password','sendMail')->name('sendmail');
    Route::post('/forget/reset','resetPassword')->name('resetPassword');
});

Route::middleware(Authenticate::class)->group(function(){
       Route::get('/dashboard',[AuthController::class , 'dashboard'])->name('dashboard');
});

