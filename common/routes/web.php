<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AdminDashboardController,
    Market\CategoryController,
    Market\BrandController,
    Market\CommentController,
    Market\DeliveryController,
    Market\DiscountController,
    Market\OrderController,

};

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
        //Brand
        Route::prefix('brand')->group(function() {
            Route::get('/' , [BrandController::class , 'index'])->name('admin.market.brand.index');
            Route::get('/create' , [BrandController::class , 'create'])->name('admin.market.brand.create');
            Route::post('/store' , [BrandController::class , 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{id}' , [BrandController::class , 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{id}' , [BrandController::class , 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{id}' , [BrandController::class , 'destroy'])->name('admin.market.brand.destroy');
            // Route::resource('/' , BrandController::class); // Can Be used And Delete All Those Above For (Brand).
        });
        //Comment
        Route::prefix('comment')->group(function() {
            Route::get('/' , [CommentController::class , 'index'])->name('admin.market.comment.index');
            Route::get('/show' , [CommentController::class , 'show'])->name('admin.market.comment.show');
            Route::post('/store' , [CommentController::class , 'store'])->name('admin.market.comment.store');
            // Route::get('/edit/{id}' , [CommentController::class , 'edit'])->name('admin.market.comment.edit');
            // Route::put('/update/{id}' , [CommentController::class , 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}' , [CommentController::class , 'destroy'])->name('admin.market.comment.destroy');
            // Route::resource('/' , CommentController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Delivery
        Route::prefix('delivery')->group(function() {
            Route::get('/' , [DeliveryController::class , 'index'])->name('admin.market.delivery.index');
            Route::get('/create' , [DeliveryController::class , 'create'])->name('admin.market.delivery.create');
            Route::post('/store' , [DeliveryController::class , 'store'])->name('admin.market.delivery.store');
            Route::get('/edit/{id}' , [DeliveryController::class , 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{id}' , [DeliveryController::class , 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{id}' , [DeliveryController::class , 'destroy'])->name('admin.market.delivery.destroy');
            // Route::resource('/' , DeliveryController::class); // Can Be used And Delete All Those Above For (Delivery).
        });
        //Discount
        Route::prefix('discount')->group(function() {
            Route::get('/copan' , [DiscountController::class , 'copan'])->name('admin.market.discount.copan');
            Route::get('/copan/create' , [DiscountController::class , 'copanCreate'])->name('admin.market.discount.copan.create');
            Route::get('/common-discount' , [DiscountController::class , 'commonDiscount'])->name('admin.market.discount.commonDiscount');
            Route::get('/common-discount/create' , [DiscountController::class , 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create');
            Route::get('/amazing-sale' , [DiscountController::class , 'amazingSale'])->name('admin.market.discount.amazingSale');
            Route::get('/amazing-sale/create' , [DiscountController::class , 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create');
        });
                //Discount
        Route::prefix('order')->group(function() {
            Route::get('/' , [OrderController::class , 'all'])->name('admin.market.order.all');
            Route::get('/new-order' , [OrderController::class , 'newOrders'])->name('admin.market.order.newOrders');
            Route::get('/sending' , [OrderController::class , 'sending'])->name('admin.market.order.sending');
            Route::get('/unpaid' , [OrderController::class , 'unpaid'])->name('admin.market.order.unpaid');
            Route::get('/canceled' , [OrderController::class , 'cancele'])->name('admin.market.order.canceled');
            Route::get('/returned' , [OrderController::class , 'returned'])->name('admin.market.order.returned');
            Route::get('/show' , [OrderController::class , 'show'])->name('admin.market.order.show');
            Route::get('/change-send-status' , [OrderController::class , 'changeSendStatus'])->name('admin.market.order.changeStatus');
            Route::get('/change-order-status' , [OrderController::class , 'changeOrderStatus'])->name('admin.market.order.orderStatus');
            Route::get('/cancel-order' , [OrderController::class , 'cancelOrder'])->name('admin.market.order.cancelOrder');
        });
    });
});





