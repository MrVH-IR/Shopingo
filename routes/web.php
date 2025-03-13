<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Products;
use App\Http\Controllers\{
    HomeController,
};


Route::get('/' , [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // این فقط برای کاربران عادی نمایش داده می‌شود
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::middleware(['auth', 'role'])->group(function () {
    Route::get('/admin/dashboard', Dashboard::class)->name('admin.dashboard');
    Route::get('/admin/products', Products::class)->name('admin.products');
});

require __DIR__.'/auth.php';
