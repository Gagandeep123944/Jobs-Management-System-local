<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authenticate;
use Inertia\Inertia;


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
    Route::get('/logout','logout')->name('logout'); 
});

// Route::middleware(Authenticate::class)->group(function(){
//        Route::get('/dashboard',[DashboardController::class , 'dashboard'])->name('dashboard');
// });


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware('auth')->name('dashboard');;

Route::view('/{any}', 'dashboard.dashboard')
    ->where('any', '^(?!api).*$');
