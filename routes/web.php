<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
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

// Informations
Route::get('/about-us', function () {
    return view('informations.about');
});

Route::get('/contact-us', function () {
    return view('informations.contact');
});

Route::get('/partnership', function() {
    return view('informations.partnership');
});
// End Informations Route
