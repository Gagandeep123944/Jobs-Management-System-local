<?php
use App\Models\Clients;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authenticate;




Route::get('/clients', function () {
    return Clients::all();
});