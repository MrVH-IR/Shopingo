<?php

use App\Http\Controllers\Admin\Market\ProductController;
use Common\Controllers\Index\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('customer.home');
})->name('customer.home');

Route::namespace('Auth')->group(function () {
    Route::get('/login-register' , [\App\Http\Controllers\Auth\Customer\LoginRegisterController::class , 'loginRegisterForm'])->name('auth.customer.login-register-form');
    Route::post('/login-register' , [\App\Http\Controllers\Auth\Customer\LoginRegisterController::class , 'loginRegister'])->name('auth.customer.login-register');
    Route::get('/login-confirm/{token}' , [\App\Http\Controllers\Auth\Customer\LoginRegisterController::class , 'loginConfirmForm'])->name('auth.customer.login-confirm-form');
    Route::post('/login-confirm/{token}' ,  [\App\Http\Controllers\Auth\Customer\LoginRegisterController::class , 'loginConfirm'])->name('auth.customer.login-confirm');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Information
Route::get('/about-us', function () {
    return view('informations.about');
});

Route::get('/contact-us', function () {
    return view('informations.contact');
});

Route::get('/partnership', function() {
    return view('informations.partnership');
});
// End Information Route
