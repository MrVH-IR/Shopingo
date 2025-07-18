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
    Market\PaymentController,
    Market\ProductController,
    Market\GalleryController,
    Market\PropertyController,
    Market\StoreController,
    Content\CategoryController as ContentCategoryContoller,
    Content\CommentController as ContentCommentController,
    Content\FAQController,
    Content\MenuController,
    Content\PageController,
    Content\PostController,

};

/**
 * -------------------------------------------------------------
 * ADMIN ROUTES ------------------------------------------------
 * -------------------------------------------------------------
 */

Route::prefix( '/admin')->namespace('Admin')->group(function() {
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
        //Order
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
        //Payment
        Route::prefix('payment')->group(function() {
            Route::get('/' , [PaymentController::class , 'index'])->name('admin.market.payment.index');
            Route::get('/online' , [PaymentController::class , 'online'])->name('admin.market.payment.online');
            Route::get('/offline' , [PaymentController::class , 'offline'])->name('admin.market.payment.offline');
            Route::get('/attendance' , [PaymentController::class , 'attendance'])->name('admin.market.payment.attendance');
            Route::get('/confirm' , [PaymentController::class , 'confirm'])->name('admin.market.payment.confirm');
        });
        //Product
        Route::prefix('Product')->group(function() {
            Route::get('/' , [ProductController::class , 'index'])->name('admin.market.product.index');
            Route::get('/create' , [ProductController::class , 'create'])->name('admin.market.product.create');
            Route::post('/store' , [ProductController::class , 'store'])->name('admin.market.product.store');
            Route::get('/edit/{id}' , [ProductController::class , 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{id}' , [ProductController::class , 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{id}' , [ProductController::class , 'destroy'])->name('admin.market.product.destroy');
            //Gallery
            Route::get('/gallery' , [GalleryController::class , 'index'])->name('admin.market.gallery.index');
            Route::post('/gallery/store' , [GalleryController::class , 'store'])->name('admin.market.gallery.store');
            Route::delete('/gallery/destroy/{id}' , [GalleryController::class , 'destroy'])->name('admin.market.gallery.destroy');
            // Route::resource('/' , ProductController::class); // Can Be used And Delete All Those Above For (Brand).
        });
        //Property
        Route::prefix('property')->group(function() {
            Route::get('/' , [PropertyController::class , 'index'])->name('admin.market.property.index');
            Route::get('/create' , [PropertyController::class , 'create'])->name('admin.market.property.create');
            Route::post('/store' , [PropertyController::class , 'store'])->name('admin.market.property.store');
            Route::get('/edit/{id}' , [PropertyController::class , 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{id}' , [PropertyController::class , 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{id}' , [PropertyController::class , 'destroy'])->name('admin.market.property.destroy');
        });
        //Store
        Route::prefix('store')->group(function() {
            Route::get('/' , [StoreController::class , 'index'])->name('admin.market.store.index');
            Route::get('/add-to-store' , [StoreController::class , 'addToStore'])->name('admin.market.store.addToStore');
            Route::post('/store' , [StoreController::class , 'store'])->name('admin.market.store.store');
            Route::get('/edit/{id}' , [StoreController::class , 'edit'])->name('admin.market.store.edit');
            Route::put('/update/{id}' , [StoreController::class , 'update'])->name('admin.market.store.update');
            Route::delete('/destroy/{id}' , [StoreController::class , 'destroy'])->name('admin.market.store.destroy');
        });
    });

    Route::prefix('content')->namespace('Content')->group(function() {
        //Category
        Route::prefix('category')->group(function() {
            Route::get('/' , [ContentCategoryContoller::class , 'index'])->name('admin.content.category.index');
            Route::get('/create' , [ContentCategoryContoller::class , 'create'])->name('admin.content.category.create');
            Route::post('/store' , [ContentCategoryContoller::class , 'store'])->name('admin.content.category.store');
            Route::get('/edit/{id}' , [ContentCategoryContoller::class , 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{id}' , [ContentCategoryContoller::class , 'update'])->name('admin.content.category.update');
            Route::delete('/destroy/{id}' , [ContentCategoryContoller::class , 'destroy'])->name('admin.content.category.destroy');
            // Route::resource('/' , ContentCategoryContoller::class); // Can Be used And Delete All Those Above For (Category).
        });
        //Comment
        Route::prefix('comment')->group(function() {
            Route::get('/' , [ContentCommentController::class , 'index'])->name('admin.content.comment.index');
            Route::get('/show' , [ContentCommentController::class , 'show'])->name('admin.content.comment.show');
            Route::post('/store' , [ContentCommentController::class , 'store'])->name('admin.content.comment.store');
            // Route::get('/edit/{id}' , [ContentCommentController::class , 'edit'])->name('admin.content.comment.edit');
            // Route::put('/update/{id}' , [ContentCommentController::class , 'update'])->name('admin.content.comment.update');
            Route::delete('/destroy/{id}' , [ContentCommentController::class , 'destroy'])->name('admin.content.comment.destroy');
            // Route::resource('/' , ContentCommentController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //FAQ
        Route::prefix('faq')->group(function() {
            Route::get('/' , [FAQController::class , 'index'])->name('admin.content.faq.index');
            Route::get('/create' , [FAQController::class , 'create'])->name('admin.content.faq.create');
            Route::post('/store' , [FAQController::class , 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{id}' , [FAQController::class , 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{id}' , [FAQController::class , 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{id}' , [FAQController::class , 'destroy'])->name('admin.content.faq.destroy');
            // Route::resource('/' , FAQController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Menu
        Route::prefix('menu')->group(function() {
            Route::get('/' , [MenuController::class , 'index'])->name('admin.content.menu.index');
            Route::get('/create' , [MenuController::class , 'create'])->name('admin.content.menu.create');
            Route::post('/store' , [MenuController::class , 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{id}' , [MenuController::class , 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{id}' , [MenuController::class , 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{id}' , [MenuController::class , 'destroy'])->name('admin.content.menu.destroy');
            // Route::resource('/' , MenuController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Page
        Route::prefix('page')->group(function() {
            Route::get('/' , [PageController::class , 'index'])->name('admin.content.page.index');
            Route::get('/create' , [PageController::class , 'create'])->name('admin.content.page.create');
            Route::post('/store' , [PageController::class , 'store'])->name('admin.content.page.store');
            Route::get('/edit/{id}' , [PageController::class , 'edit'])->name('admin.content.page.edit');
            Route::put('/update/{id}' , [PageController::class , 'update'])->name('admin.content.page.update');
            Route::delete('/destroy/{id}' , [PageController::class , 'destroy'])->name('admin.content.page.destroy');
            // Route::resource('/' , PageController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Post
        Route::prefix('post')->group(function() {
            Route::get('/' , [PostController::class , 'index'])->name('admin.content.post.index');
            Route::get('/create' , [PostController::class , 'create'])->name('admin.content.post.create');
            Route::post('/store' , [PostController::class , 'store'])->name('admin.content.post.store');
            Route::get('/edit/{id}' , [PostController::class , 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{id}' , [PostController::class , 'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{id}' , [PostController::class , 'destroy'])->name('admin.content.post.destroy');
            // Route::resource('/' , PostController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
});





