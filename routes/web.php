<?php

use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use Common\Controllers\Home\HomeController;
use Common\Controllers\Market\{ProductController,};
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class , 'index'])->name('customer.home');

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

Route::namespace('Auth')->middleware('throttle:5,1')->group(function () {
    Route::get('/login-register' , [LoginRegisterController::class , 'loginRegisterForm'])->name('auth.customer.login-register-form');
    Route::post('/login-register' , [LoginRegisterController::class , 'loginRegister'])->name('auth.customer.login-register');
    Route::get('/login-confirm/{token}' , [LoginRegisterController::class , 'loginConfirmForm'])->name('auth.customer.login-confirm-form');
    Route::post('/login-confirm/{token}' ,  [LoginRegisterController::class , 'loginConfirm'])->name('auth.customer.login-confirm');
    Route::post('/logout' , [LoginRegisterController::class , 'logout'])->name('auth.customer.logout');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Market
Route::prefix('market')
    ->name('customer.market.')
    ->middleware('throttle:50,5')
    ->group(function () {
        Route::get('/product/{product:slug}', [ProductController::class, 'product'])->name('product');
        Route::post('/add-comment/product/{product:slug}', [ProductController::class, 'add-comment'])->name('add-comment');
        Route::middleware('auth')->group(function () {
            Route::post('/favorite/{product:slug}', [ProductController::class, 'toggleFavorite'])->name('product.favorite');
        });
    });
