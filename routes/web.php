<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    Market\CategoryController,
    Market\BrandController,
    Market\CommentController,

};


Route::get('/', function () {
    return view('welcome');
});








/**
 * -------------------------------------------------------------
 * ADMIN ROUTES ------------------------------------------------
 * -------------------------------------------------------------
 */

Route::prefix('/admin')->namespace('Admin')->group(function() {
    Route::get('/' , [AdminDashboardController::class , 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function() {
        //Category
        Route::prefix('category')->group(function() {
            Route::get('/' , [CategoryController::class , 'index'])->name('admin.market.category.index');
            Route::get('/create' , [CategoryController::class , 'create'])->name('admin.market.category.create');
            Route::post('/store' , [CategoryController::class , 'store'])->name('admin.market.category.store');
            Route::get('/edit/{id}' , [CategoryController::class , 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{id}' , [CategoryController::class , 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{id}' , [CategoryController::class , 'destroy'])->name('admin.market.category.destroy');
            // Route::resource('/' , CategoryController::class); // Can Be used And Delete All Those Above For (Category).
        });
        Route::prefix('brand')->group(function() {
            Route::get('/' , [BrandController::class , 'index'])->name('admin.market.brand.index');
            Route::get('/create' , [BrandController::class , 'create'])->name('admin.market.brand.create');
            Route::post('/store' , [BrandController::class , 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{id}' , [BrandController::class , 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{id}' , [BrandController::class , 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{id}' , [BrandController::class , 'destroy'])->name('admin.market.brand.destroy');
            // Route::resource('/' , BrandController::class); // Can Be used And Delete All Those Above For (Category).
        });
        Route::prefix('comment')->group(function() {
            Route::get('/' , [CommentController::class , 'index'])->name('admin.market.comment.index');
            Route::get('/show' , [CommentController::class , 'show'])->name('admin.market.comment.show');
            Route::post('/store' , [CommentController::class , 'store'])->name('admin.market.comment.store');
            // Route::get('/edit/{id}' , [CommentController::class , 'edit'])->name('admin.market.comment.edit');
            // Route::put('/update/{id}' , [CommentController::class , 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}' , [CommentController::class , 'destroy'])->name('admin.market.comment.destroy');
            // Route::resource('/' , CommentController::class); // Can Be used And Delete All Those Above For (Category).
        });

    });
});

/**
 * -------------------------------------------------------------
 * USER ROUTES ------------------------------------------------
 * -------------------------------------------------------------
 */
