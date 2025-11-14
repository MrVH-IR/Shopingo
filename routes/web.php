<?php

use App\Http\Controllers\Admin\Market\ProductController;
use Common\Controllers\Index\HomeController;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class , 'index']);

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
