<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminDashboardController,
    LockScreenController,
    Market\CategoryController,
    Market\BrandController,
    Market\CommentController,
    Market\DeliveryController,
    Market\DiscountController,
    Market\OrderController,
    Market\PaymentController,
    Market\ProductColorController,
    Market\ProductController,
    Market\GalleryController,
    Market\PropertyController,
    Market\PropertyValueController,
    Market\StoreController,
    Market\GuaranteeController,
    Content\CategoryController as ContentCategoryController,
    Content\CommentController as ContentCommentController,
    Content\FAQController,
    Content\MenuController,
    Content\PageController,
    Content\PostController,
    Content\BannerController,
    User\AdminUserController,
    User\CustomerController,
    User\RoleController,
    User\PermissionController,
    Notification\EmailController,
    Notification\SMSController,
    Ticket\TicketController,
    Ticket\TicketPriorityController,
    Ticket\TicketCategoryController,
    Ticket\TicketAdminController,
    Setting\SettingController};

/**
 * -------------------------------------------------------------
 * ADMIN ROUTES ------------------------------------------------
 * -------------------------------------------------------------
 */

Route::middleware(['auth:sanctum', config('jetstream.auth_session') , 'verified', 'admin', 'lock-screen'])->prefix( '/admin')->group(function() {
    Route::get('/' , [AdminDashboardController::class , 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function() {
        //Category
        Route::prefix('category')->group(function() {
            Route::get('/' , [CategoryController::class , 'index'])->name('admin.market.category.index')->can('categories.view');
            Route::get('/create' , [CategoryController::class , 'create'])->name('admin.market.category.create')->can('categories.create');
            Route::post('/store' , [CategoryController::class , 'store'])->name('admin.market.category.store')->can('categories.create');
            Route::get('/edit/{productCategory}' , [CategoryController::class , 'edit'])->name('admin.market.category.edit')->can('categories.edit');
            Route::put('/update/{productCategory}' , [CategoryController::class , 'update'])->name('admin.market.category.update')->can('categories.edit');
            Route::delete('/destroy/{productCategory}' , [CategoryController::class , 'destroy'])->name('admin.market.category.destroy')->can('categories.destroy');
            // Route::resource('/' , CategoryController::class); // Can Be used And Delete All Those Above For (Category).
        });
        //Brand
        Route::prefix('brand')->group(function() {
            Route::get('/' , [BrandController::class , 'index'])->name('admin.market.brand.index')->can('brands.view');
            Route::get('/create' , [BrandController::class , 'create'])->name('admin.market.brand.create')->can('brands.create');
            Route::post('/store' , [BrandController::class , 'store'])->name('admin.market.brand.store')->can('brands.create');
            Route::get('/edit/{brand}' , [BrandController::class , 'edit'])->name('admin.market.brand.edit')->can('brands.edit');
            Route::put('/update/{brand}' , [BrandController::class , 'update'])->name('admin.market.brand.update')->can('brands.edit');
            Route::delete('/destroy/{brand}' , [BrandController::class , 'destroy'])->name('admin.market.brand.destroy')->can('brands.destroy');
            Route::get('/status/{brand}' , [BrandController::class , 'status'])->name('admin.market.brand.status')->can('brands.status');
            // Route::resource('/' , BrandController::class); // Can Be used And Delete All Those Above For (Brand).
        });
        //Comment
        Route::prefix('comment')->group(function() {
            Route::get('/' , [CommentController::class , 'index'])->name('admin.market.comment.index')->can('comment.show');
            Route::get('/show/{comment}' , [CommentController::class , 'show'])->name('admin.market.comment.show')->can('comment.show');
            // Route::post('/store' , [CommentController::class , 'store'])->name('admin.market.comment.store');
            // Route::get('/edit/{id}' , [CommentController::class , 'edit'])->name('admin.market.comment.edit');
            // Route::put('/update/{id}' , [CommentController::class , 'update'])->name('admin.market.comment.update');
            Route::delete('/destroy/{id}' , [CommentController::class , 'destroy'])->name('admin.market.comment.destroy')->can('comment.destroy');
            Route::get('/status/{comment}', [CommentController::class , 'status'])->name('admin.market.comment.status')->can('comment.status');
            Route::post('/approved/{comment}', [CommentController::class , 'approved'])->name('admin.market.comment.approved')->can('comment.approved');
            Route::post('/answer/{comment}', [CommentController::class , 'answer'])->name('admin.market.comment.answer')->can('comment.answer');

        });
        //Delivery
        Route::prefix('delivery')->group(function() {
            Route::get('/' , [DeliveryController::class , 'index'])->name('admin.market.delivery.index')->can('delivery.view');
            Route::get('/create' , [DeliveryController::class , 'create'])->name('admin.market.delivery.create')->can('delivery.create');
            Route::post('/store' , [DeliveryController::class , 'store'])->name('admin.market.delivery.store')->can('delivery.store');
            Route::get('/edit/{delivery}' , [DeliveryController::class , 'edit'])->name('admin.market.delivery.edit')->can('delivery.edit');
            Route::put('/update/{delivery}' , [DeliveryController::class , 'update'])->name('admin.market.delivery.update')->can('delivery.edit');
            Route::delete('/destroy/{delivery}' , [DeliveryController::class , 'destroy'])->name('admin.market.delivery.destroy')->can('delivery.destroy');
            Route::get('/status/{delivery}' , [DeliveryController::class , 'status'])->name('admin.market.delivery.status')->can('delivery.edit');
            // Route::resource('/' , DeliveryController::class); // Can Be used And Delete All Those Above For (Delivery).
        });
        //Discount
        Route::prefix('discount')->group(function() {
            Route::get('/copan' , [DiscountController::class , 'copan'])->name('admin.market.discount.copan')->can('discounts.view');
            Route::get('/copan/create' , [DiscountController::class , 'copanCreate'])->name('admin.market.discount.copan.create')->can('discounts.create');
            Route::get('/copan/create/users', [DiscountController::class, 'ajaxUsers'])->name('admin.market.discount.users')->can('discounts.create');
            Route::post('/copan/store' , [DiscountController::class , 'copanStore'])->name('admin.market.discount.copan.store')->can('discounts.create');
            Route::get('/coupon/edit/{coupon}' , [DiscountController::class , 'couponEdit'])->name('admin.market.discount.coupon.edit')->can('discounts.edit');
            Route::put('/coupon/update/{coupon}' , [DiscountController::class , 'couponUpdate'])->name('admin.market.discount.coupon.update')->can('discounts.edit');
            Route::delete('/coupon/destroy/{coupon}' , [DiscountController::class , 'couponDestroy'])->name('admin.market.discount.coupon.destroy')->can('discounts.destroy');

            Route::get('/common-discount' , [DiscountController::class , 'commonDiscount'])->name('admin.market.discount.commonDiscount')->can('discounts.view');
            Route::get('/common-discount/create' , [DiscountController::class , 'commonDiscountCreate'])->name('admin.market.discount.commonDiscount.create')->can('discounts.create');
            Route::post('/common-discount/store' , [DiscountController::class , 'commonDiscountStore'])->name('admin.market.discount.commonDiscount.store')->can('discounts.create');
            Route::get('/common-discount/edit/{commonDiscount}' , [DiscountController::class , 'commonDiscountEdit'])->name('admin.market.discount.commonDiscount.edit')->can('discounts.edit');
            Route::put('/common-discount/update/{commonDiscount}' , [DiscountController::class , 'commonDiscountUpdate'])->name('admin.market.discount.commonDiscount.update')->can('discounts.edit');
            Route::delete('/common-discount/destroy/{commonDiscount}' , [DiscountController::class , 'commonDiscountDestroy'])->name('admin.market.discount.commonDiscount.destroy')->can('discounts.destroy');

            Route::get('/amazing-sale' , [DiscountController::class , 'amazingSale'])->name('admin.market.discount.amazingSale')->can('discounts.view');
            Route::get('/amazing-sale/create' , [DiscountController::class , 'amazingSaleCreate'])->name('admin.market.discount.amazingSale.create')->can('discounts.create');
            Route::post('/amazing-sale/store' , [DiscountController::class , 'amazingSaleStore'])->name('admin.market.discount.amazingSale.store')->can('discounts.create');
            Route::get('/amazing-sale/edit/{amazingSale}' , [DiscountController::class , 'amazingSaleEdit'])->name('admin.market.discount.amazingSale.edit')->can('discounts.edit');
            Route::put('/amazing-sale/update/{amazingSale}' , [DiscountController::class , 'amazingSaleUpdate'])->name('admin.market.discount.amazingSale.update')->can('discounts.edit');
            Route::delete('/amazing-sale/destroy/{amazingSale}' , [DiscountController::class , 'amazingSaleDestroy'])->name('admin.market.discount.amazingSale.destroy')->can('discounts.destroy');

        });
        //Order
        Route::prefix('order')->group(function() {
            Route::get('/' , [OrderController::class , 'all'])->name('admin.market.order.all')->can('orders.view');
            Route::get('/new-order' , [OrderController::class , 'newOrders'])->name('admin.market.order.newOrders')->can('orders.view');
            Route::get('/sending' , [OrderController::class , 'sending'])->name('admin.market.order.sending')->can('orders.view');
            Route::get('/unpaid' , [OrderController::class , 'unpaid'])->name('admin.market.order.unpaid')->can('orders.view');
            Route::get('/canceled' , [OrderController::class , 'cancele'])->name('admin.market.order.canceled')->can('orders.view');
            Route::get('/returned' , [OrderController::class , 'returned'])->name('admin.market.order.returned')->can('orders.view');
            Route::get('/show/{order}' , [OrderController::class , 'show'])->name('admin.market.order.show')->can('orders.view');
            Route::get('/change-send-status/{order}' , [OrderController::class , 'changeSendStatus'])->name('admin.market.order.changeStatus')->can('orders.change-status');
            Route::get('show/{order}/detail' , [OrderController::class , 'showDetail'])->name('admin.market.order.showDetail')->can('orders.show');
            Route::get('/change-order-status/{order}' , [OrderController::class , 'changeOrderStatus'])->name('admin.market.order.orderStatus')->can('orders.change-status');
            Route::get('/cancel-order/{order}' , [OrderController::class , 'cancelOrder'])->name('admin.market.order.cancelOrder')->can('orders.cancel');
        });
        //Payment
        Route::prefix('payment')->group(function() {
            Route::get('/' , [PaymentController::class , 'index'])->name('admin.market.payment.index')->can('payments.view');
            Route::get('/online' , [PaymentController::class , 'online'])->name('admin.market.payment.online')->can('payments.view');
            Route::get('/offline' , [PaymentController::class , 'offline'])->name('admin.market.payment.offline')->can('payments.view');
            Route::get('/cash' , [PaymentController::class , 'cash'])->name('admin.market.payment.cash')->can('payments.view');
            Route::get('/canceled/{payment}' , [PaymentController::class , 'canceled'])->name('admin.market.payment.canceled')->can('payments.cancel');
            Route::get('/returned/{payment}' , [PaymentController::class , 'returned'])->name('admin.market.payment.returned')->can('payments.return');
            Route::get('/confirm/{payment}' , [PaymentController::class , 'confirm'])->name('admin.market.payment.confirm')->can('payments.confirm');
            Route::get('/show/{payment}' , [PaymentController::class , 'show'])->name('admin.market.payment.show')->can('payments.view');
        });
        //Product
        Route::prefix('product')->group(function() {
            Route::get('/' , [ProductController::class , 'index'])->name('admin.market.product.index')->can('products.view');
            Route::get('/create' , [ProductController::class , 'create'])->name('admin.market.product.create')->can('products.create');
            Route::post('/store' , [ProductController::class , 'store'])->name('admin.market.product.store')->can('products.create');
            Route::get('/edit/{product}' , [ProductController::class , 'edit'])->name('admin.market.product.edit')->can('products.edit');
            Route::put('/update/{product}' , [ProductController::class , 'update'])->name('admin.market.product.update')->can('products.edit');
            Route::delete('/destroy/{product}' , [ProductController::class , 'destroy'])->name('admin.market.product.destroy')->can('products.destroy');
            Route::get('/status{product}' , [ProductController::class , 'status'])->name('admin.market.product.status')->can('products.status');

            //colors
            Route::get('/color/{product}' , [ProductColorController::class , 'index'])->name('admin.market.color.index')->can('colors.view');
            Route::get('/color/{product}/create' , [ProductColorController::class , 'create'])->name('admin.market.color.create')->can('colors.create');
            Route::post('/color/{product}/store' , [ProductColorController::class , 'store'])->name('admin.market.color.store')->can('colors.create');
            Route::delete('/color/destroy/{product}/{color}' , [ProductColorController::class , 'destroy'])->name('admin.market.color.destroy')->can('colors.destroy');
            //Gallery
            Route::get('/gallery/{product}' , [GalleryController::class , 'index'])->name('admin.market.gallery.index')->can('gallery.view');
            Route::get('/gallery/create/{product}' , [GalleryController::class , 'create'])->name('admin.market.gallery.create')->can('gallery.create');
            Route::post('/gallery/store/{product}' , [GalleryController::class , 'store'])->name('admin.market.gallery.store')->can('gallery.create');
            Route::delete('/gallery/destroy/{product}/{productImage}' , [GalleryController::class , 'destroy'])->name('admin.market.gallery.destroy')->can('gallery.destroy');

            Route::get('/gallery/change-size/{productImage}' , [GalleryController::class , 'changeSize'])->name('admin.market.gallery.changeSize')->can('gallery.change-size');

            // Guarantee
            Route::get('guarantee/{product}' , [GuaranteeController::class , 'index'])->name('admin.market.guarantee.index')->can('guarantees.view');
            Route::get('guarantee/create/{product}' , [GuaranteeController::class , 'create'])->name('admin.market.guarantee.create')->can('guarantees.create');
            Route::post('guarantee/store/{product}' , [GuaranteeController::class , 'store'])->name('admin.market.guarantee.store')->can('guarantees.create');
            Route::delete('guarantee/destroy/{product}/{guarantee}' , [GuaranteeController::class , 'destroy'])->name('admin.market.guarantee.destroy')->can('guarantees.destroy');
            // Route::resource('/' , ProductController::class); // Can Be used And Delete All Those Above For (Brand).
        });
        //Property
        Route::prefix('property')->group(function() {
            Route::get('/' , [PropertyController::class , 'index'])->name('admin.market.property.index')->can('properties.view');
            Route::get('/create' , [PropertyController::class , 'create'])->name('admin.market.property.create')->can('properties.create');
            Route::post('/store' , [PropertyController::class , 'store'])->name('admin.market.property.store')->can('properties.create');
            Route::get('/edit/{categoryAttribute}' , [PropertyController::class , 'edit'])->name('admin.market.property.edit')->can('properties.edit');
            Route::put('/update/{categoryAttribute}' , [PropertyController::class , 'update'])->name('admin.market.property.update')->can('properties.edit');
            Route::delete('/destroy/{categoryAttribute}' , [PropertyController::class , 'destroy'])->name('admin.market.property.destroy')->can('properties.destroy');

            //value
            Route::get('/value/{categoryAttribute}' , [PropertyValueController::class , 'index'])->name('admin.market.value.index')->can('property-values.view');
            Route::get('/value/create/{categoryAttribute}' , [PropertyValueController::class , 'create'])->name('admin.market.value.create')->can('property-values.create');
            Route::post('/value/store/{categoryAttribute}' , [PropertyValueController::class , 'store'])->name('admin.market.value.store')->can('property-values.create');
            Route::get('/value/edit/{categoryAttribute}/{value}' , [PropertyValueController::class , 'edit'])->name('admin.market.value.edit')->can('property-values.edit');
            Route::put('/value/update/{categoryAttribute}/{value}' , [PropertyValueController::class , 'update'])->name('admin.market.value.update')->can('property-values.edit');
            Route::delete('/value/destroy/{categoryAttribute}/{value}' , [PropertyValueController::class , 'destroy'])->name('admin.market.value.destroy')->can('property-values.destroy');
        });
        //Store
        Route::prefix('store')->group(function() {
            Route::get('/' , [StoreController::class , 'index'])->name('admin.market.store.index')->can('store.view');
            Route::get('/add-to-store/{product}' , [StoreController::class , 'addToStore'])->name('admin.market.store.addToStore')->can('store.create');
            Route::post('/store/{product}' , [StoreController::class , 'store'])->name('admin.market.store.store')->can('store.create');
            Route::get('/edit/{product}' , [StoreController::class , 'edit'])->name('admin.market.store.edit')->can('store.edit');
            Route::put('/update/{product}' , [StoreController::class , 'update'])->name('admin.market.store.update')->can('store.edit');
        });
    });

    Route::prefix('content')->namespace('Content')->group(function() {
        //Category
        Route::prefix('category')->group(function() {
            Route::get('/' , [ContentCategoryController::class , 'index'])->name('admin.content.category.index')->can('category-content.view');
            Route::get('/create' , [ContentCategoryController::class , 'create'])->name('admin.content.category.create')->can('category-content.create');
            Route::post('/store' , [ContentCategoryController::class , 'store'])->name('admin.content.category.store')->can('category-content.store');
            Route::get('/edit/{postCategory}' , [ContentCategoryController::class , 'edit'])->name('admin.content.category.edit')->can('category-content.edit');
            Route::put('/update/{postCategory}' , [ContentCategoryController::class , 'update'])->name('admin.content.category.update')->can('category-content.edit');
            Route::delete('/destroy/{postCategory}' , [ContentCategoryController::class , 'destroy'])->name('admin.content.category.destroy')->can('category-content.destroy');
            Route::get('/status/{postCategory}' , [ContentCategoryController::class , 'status'])->name('admin.content.category.status')->can('category-content.status');
            // Route::resource('/' , ContentCategoryController::class); // Can Be used And Delete All Those Above For (Category).
        });
        //Comment
        Route::prefix('comment')->group(function() {
            Route::get('/' , [ContentCommentController::class , 'index'])->name('admin.content.comment.index')->can('comment.show');
            Route::get('/show/{comment}' , [ContentCommentController::class , 'show'])->name('admin.content.comment.show')->can('comment.show');
            Route::get('/status/{comment}', [ContentCommentController::class , 'status'])->name('admin.content.comment.status')->can('comment.status');
            Route::post('/approved/{comment}', [ContentCommentController::class , 'approved'])->name('admin.content.comment.approved')->can('comment.approved');
            Route::post('/answer/{comment}', [ContentCommentController::class , 'answer'])->name('admin.content.comment.answer')->can('comment.answer');
        });
        //FAQ
        Route::prefix('faq')->group(function() {
            Route::get('/' , [FAQController::class , 'index'])->name('admin.content.faq.index')->can('faq.view');
            Route::get('/create' , [FAQController::class , 'create'])->name('admin.content.faq.create')->can('faq.create');
            Route::post('/store' , [FAQController::class , 'store'])->name('admin.content.faq.store')->can('faq.edit');
            Route::get('/edit/{faq}' , [FAQController::class , 'edit'])->name('admin.content.faq.edit')->can('faq.edit');
            Route::put('/update/{faq}' , [FAQController::class , 'update'])->name('admin.content.faq.update')->can('faq.edit');
            Route::delete('/destroy/{faq}' , [FAQController::class , 'destroy'])->name('admin.content.faq.destroy')->can('faq.destroy');
            Route::get('/status/{faq}' , [FAQController::class , 'status'])->name('admin.content.faq.status')->can('faq.edit');
            // Route::resource('/' , FAQController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Menu
        Route::prefix('menu')->group(function() {
            Route::get('/' , [MenuController::class , 'index'])->name('admin.content.menu.index')->can('menus.view');
            Route::get('/create' , [MenuController::class , 'create'])->name('admin.content.menu.create')->can('menus.create');
            Route::post('/store' , [MenuController::class , 'store'])->name('admin.content.menu.store')->can('menus.create');
            Route::get('/edit/{menu}' , [MenuController::class , 'edit'])->name('admin.content.menu.edit')->can('menus.edit');
            Route::put('/update/{menu}' , [MenuController::class , 'update'])->name('admin.content.menu.update')->can('menus.edit');
            Route::delete('/destroy/{menu}' , [MenuController::class , 'destroy'])->name('admin.content.menu.destroy')->can('menus.destroy');
            Route::get('/status/{menu}' , [MenuController::class , 'status'])->name('admin.content.menu.status')->can('menus.edit');
            // Route::resource('/' , MenuController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Page
        Route::prefix('page')->group(function() {
            Route::get('/' , [PageController::class , 'index'])->name('admin.content.page.index')->can('pages.view');
            Route::get('/create' , [PageController::class , 'create'])->name('admin.content.page.create')->can('pages.create');
            Route::post('/store' , [PageController::class , 'store'])->name('admin.content.page.store')->can('pages.create');
            Route::get('/edit/{page}' , [PageController::class , 'edit'])->name('admin.content.page.edit')->can('pages.edit');
            Route::put('/update/{page}' , [PageController::class , 'update'])->name('admin.content.page.update')->can('pages.edit');
            Route::delete('/destroy/{page}' , [PageController::class , 'destroy'])->name('admin.content.page.destroy')->can('pages.destroy');
            Route::get('/status/{page}' , [PageController::class , 'status'])->name('admin.content.page.status')->can('pages.edit');
            // Route::resource('/' , PageController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Post
        Route::prefix('post')->group(function() {
            Route::get('/' , [PostController::class , 'index'])->name('admin.content.post.index')->can('posts.view');
            Route::get('/create' , [PostController::class , 'create'])->name('admin.content.post.create')->can('posts.create');
            Route::post('/store' , [PostController::class , 'store'])->name('admin.content.post.store')->can('posts.create');
            Route::get('/edit/{post}' , [PostController::class , 'edit'])->name('admin.content.post.edit')->can('posts.edit');
            Route::put('/update/{post}' , [PostController::class , 'update'])->name('admin.content.post.update')->can('posts.edit');
            Route::delete('/destroy/{post}' , [PostController::class , 'destroy'])->name('admin.content.post.destroy')->can('posts.destroy');
            Route::get('/status/{post}' , [PostController::class , 'status'])->name('admin.content.post.status')->can('posts.edit');
            Route::get('/commentable/{post}' , [PostController::class , 'commentable'])->name('admin.content.post.commentable')->can('posts.edit');
            // Route::resource('/' , PostController::class); // Can Be used And Delete All Those Above For (Comment).
        });

        Route::prefix('banner')->group(function() {
            Route::get('/', [BannerController::class , 'index'])->name('admin.content.banner.index')->can('banners.view');
            Route::get('/create', [BannerController::class , 'create'])->name('admin.content.banner.create')->can('banners.create');
            Route::post('/store' , [BannerController::class , 'store'])->name('admin.content.banner.store')->can('banners.create');
            Route::get('/edit/{banner}' , [BannerController::class , 'edit'])->name('admin.content.banner.edit')->can('banners.edit');
            Route::put('/update/{banner}' , [BannerController::class , 'update'])->name('admin.content.banner.update')->can('banners.edit');
            Route::delete('/destroy/{banner}', [BannerController::class , 'destroy'])->name('admin.content.banner.destroy')->can('banners.destroy');
            Route::get('/status/{banner}' , [BannerController::class , 'status'])->name('admin.content.banner.status')->can('banners.edit');
        });
    });
    //User Prefix
    Route::prefix('user')->namespace('User')->group(function () {
        //Admin
        Route::prefix('admin-user')->group(function() {
            Route::get('/' , [AdminUserController::class , 'index'])->name('admin.user.admin-user.index')->can('admin-user.view');
            Route::get('/create' , [AdminUserController::class , 'create'])->name('admin.user.admin-user.create')->can('admin-user.create');
            Route::post('/store' , [AdminUserController::class , 'store'])->name('admin.user.admin-user.store')->can('admin-user.store');
            Route::get('/edit/{user}' , [AdminUserController::class , 'edit'])->name('admin.user.admin-user.edit')->can('admin-user.edit');
            Route::put('/update/{user}' , [AdminUserController::class , 'update'])->name('admin.user.admin-user.update')->can('admin-user.edit');
            Route::delete('/destroy/{id}' , [AdminUserController::class , 'destroy'])->name('admin.user.admin-user.destroy')->can('admin-user.destroy');
            Route::get('/activation/{user}' , [AdminUserController::class , 'activation'])->name('admin.user.admin-user.activation')->can('admin-user.activation');
            Route::get('/status/{user}' , [AdminUserController::class , 'status'])->name('admin.user.admin-user.status')->can('admin-user.status');
            // Route::resource('/' , AdminUserController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Customer
        Route::prefix('customer')->group(function() {
            Route::get('/' , [CustomerController::class , 'index'])->name('admin.user.customer.index')->can('users.view');
            Route::get('/create' , [CustomerController::class , 'create'])->name('admin.user.customer.create')->can('users.create');
            Route::post('/store' , [CustomerController::class , 'store'])->name('admin.user.customer.store')->can('users.create');
            Route::get('/edit/{user}' , [CustomerController::class , 'edit'])->name('admin.user.customer.edit')->can('users.edit');
            Route::put('/update/{user}' , [CustomerController::class , 'update'])->name('admin.user.customer.update')->can('users.edit');
            Route::delete('/destroy/{id}' , [CustomerController::class , 'destroy'])->name('admin.user.customer.destroy')->can('users.destroy');
            Route::get('/status/{user}' , [CustomerController::class , 'status'])->name('admin.user.customer.status')->can('users.edit');
            Route::get('/activation/{user}' , [CustomerController::class , 'activation'])->name('admin.user.customer.activation')->can('users.edit');
            // Route::resource('/' , CustomerController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Role
        Route::prefix('role')->group(function() {
            Route::get('/' , [RoleController::class , 'index'])->name('admin.user.role.index')->can('roles.view');
            Route::get('/create' , [RoleController::class , 'create'])->name('admin.user.role.create')->can('roles.create');
            Route::post('/store' , [RoleController::class , 'store'])->name('admin.user.role.store')->can('roles.create');
            Route::get('/edit/{role}' , [RoleController::class , 'edit'])->name('admin.user.role.edit')->can('roles.edit');
            Route::put('/update/{role}' , [RoleController::class , 'update'])->name('admin.user.role.update')->can('roles.edit');
            Route::delete('/destroy/{role}' , [RoleController::class , 'destroy'])->name('admin.user.role.destroy')->can('roles.destroy');
            Route::get('/status/{role}' , [RoleController::class , 'status'])->name('admin.user.role.status')->can('roles.edit');
            // Route::resource('/' , RoleController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Permission
        Route::prefix('permission')->group(function() {
            Route::get('/{user}' , [PermissionController::class , 'index'])->name('admin.user.permission.index')->can('permissions.view');
            Route::get('/create' , [PermissionController::class , 'create'])->name('admin.user.permission.create')->can('permissions.edit');
            Route::post('/store/{user}' , [PermissionController::class , 'store'])->name('admin.user.permission.store')->can('permissions.edit');
            Route::get('/edit/{id}' , [PermissionController::class , 'edit'])->name('admin.user.permission.edit')->can('permissions.edit');
            Route::put('/update/{id}' , [PermissionController::class , 'update'])->name('admin.user.permission.update')->can('permissions.edit');
            Route::delete('/destroy/{user}' , [PermissionController::class , 'destroy'])->name('admin.user.permission.destroy')->can('permissions.edit');
            // Route::resource('/' , PermissionController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
    //Notification
    Route::prefix('notification')->namespace('Notification')->group(function () {
        Route::prefix('email')->group(function () {
            //Email
            Route::get('/' , [EmailController::class , 'index'])->name('admin.email.index')->can('notifications.view');
            Route::get('/create' , [EmailController::class , 'create'])->name('admin.email.create')->can('notifications.create');
            Route::post('/store' , [EmailController::class , 'store'])->name('admin.email.store')->can('notifications.create');
            Route::get('/edit/{email}' , [EmailController::class , 'edit'])->name('admin.email.edit')->can('notifications.create');
            Route::put('/update/{email}' , [EmailController::class , 'update'])->name('admin.email.update')->can('notifications.create');
            Route::delete('/destroy/{email}' , [EmailController::class , 'destroy'])->name('admin.email.destroy')->can('notifications.create');
            Route::get('/status/{email}' , [EmailController::class , 'status'])->name('admin.email.status')->can('notifications.create');
            Route::get('/file/{file}' , [EmailController::class , 'downloadFile'])->name('admin.email.file.download')->can('notifications.create');
            Route::get('/file/view/{email}' , [EmailController::class , 'viewFile'])->name('admin.email.file.view')->can('notifications.create');
            Route::delete('/email/file/delete/{emailFile}', [EmailController::class, 'deleteFile'])->name('admin.email.file.delete')->can('notifications.create');
            // Route::resource('/' , EmailController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //SMS
        Route::prefix('sms')->group(function () {
            Route::get('/' , [SMSController::class , 'index'])->name('admin.sms.index')->can('notifications.view');
            Route::get('/create' , [SMSController::class , 'create'])->name('admin.sms.create')->can('notifications.create');
            Route::post('/store' , [SMSController::class , 'store'])->name('admin.sms.store')->can('notifications.create');
            Route::get('/edit/{sms}' , [SMSController::class , 'edit'])->name('admin.sms.edit')->can('notifications.create');
            Route::put('/update/{sms}' , [SMSController::class , 'update'])->name('admin.sms.update')->can('notifications.create');
            Route::delete('/destroy/{sms}' , [SMSController::class , 'destroy'])->name('admin.sms.destroy')->can('notifications.create');
            Route::get('/status/{sms}' , [SMSController::class , 'status'])->name('admin.sms.status')->can('notifications.create');
            // Route::resource('/' , SmsController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/' , [TicketCategoryController::class , 'index'])->name('admin.ticket.category.index')->can('tickets.view');
            Route::get('/create' , [TicketCategoryController::class , 'create'])->name('admin.ticket.category.create')->can('tickets.create');
            Route::post('/store' , [TicketCategoryController::class , 'store'])->name('admin.ticket.category.store')->can('tickets.create');
            Route::get('/edit/{ticketCategory}' , [TicketCategoryController::class , 'edit'])->name('admin.ticket.category.edit')->can('tickets.create');
            Route::put('/update/{ticketCategory}' , [TicketCategoryController::class , 'update'])->name('admin.ticket.category.update')->can('tickets.create');
            Route::delete('/destroy/{ticketCategory}' , [TicketCategoryController::class , 'destroy'])->name('admin.ticket.category.destroy')->can('tickets.change');
            Route::get('/status/{ticketCategory}' , [TicketCategoryController::class , 'status'])->name('admin.ticket.category.status')->can('tickets.change');
        });

        Route::prefix('priority')->group(function () {
            Route::get('/' , [TicketPriorityController::class , 'index'])->name('admin.ticket.priority.index')->can('tickets.view');
            Route::get('/create' , [TicketPriorityController::class , 'create'])->name('admin.ticket.priority.create')->can('tickets.create');
            Route::post('/store' , [TicketPriorityController::class , 'store'])->name('admin.ticket.priority.store')->can('tickets.create');
            Route::get('/edit/{ticketPriority}' , [TicketPriorityController::class , 'edit'])->name('admin.ticket.priority.edit')->can('tickets.change');
            Route::put('/update/{ticketPriority}' , [TicketPriorityController::class , 'update'])->name('admin.ticket.priority.update')->can('tickets.change');
            Route::delete('/destroy/{ticketPriority}' , [TicketPriorityController::class , 'destroy'])->name('admin.ticket.priority.destroy')->can('tickets.change');
            Route::get('/status/{ticketPriority}' , [TicketPriorityController::class , 'status'])->name('admin.ticket.priority.status')->can('tickets.change');
        });

        Route::prefix('admin')->group(function () {
            Route::get('/' , [TicketAdminController::class , 'index'] )->name('admin.ticket.admin.index')->can('tickets.create');
            Route::get('/set/{admin}' , [TicketAdminController::class , 'set'])->name('admin.ticket.admin.set')->can('tickets.change');
        });
        //Main
        Route::get('/' , [TicketController::class , 'index'])->name('admin.ticket.index')->can('tickets.view');
        Route::get('/new-tickets' , action: [TicketController::class , 'newTickets'])->name('admin.ticket.newtickets')->can('tickets.view');
        Route::get('/open-tickets' , [TicketController::class , 'openTickets'])->name('admin.ticket.opentickets')->can('tickets.view');
        Route::get('/close-tickets' , [TicketController::class , 'closeTickets'])->name('admin.ticket.closetickets')->can('tickets.view');
        Route::get('/create' , [TicketController::class , 'create'])->name('admin.ticket.create')->can('tickets.create');
        Route::get('/show/{ticket}' , [TicketController::class , 'show'])->name('admin.ticket.show')->can('tickets.view');
        Route::post('/answer/{ticket}' , [TicketController::class , 'answer'])->name('admin.ticket.answer')->can('tickets.answer');
        Route::get('/change/{ticket}' , [TicketController::class , 'change'])->name('admin.ticket.change')->can('tickets.change');
    });

    Route::prefix('setting')->namespace('Setting')->group(function() {
            Route::get('/' , [SettingController::class , 'index'])->name('admin.setting.index')->can('settings.view');
            Route::get('/edit/{setting}' , [SettingController::class , 'edit'])->name('admin.setting.edit')->can('settings.edit');
            Route::put('/update/{setting}' , [SettingController::class , 'update'])->name('admin.setting.update')->can('settings.edit');
            Route::post('/optimization', [SettingController::class, 'optimizeApp'])->name('admin.setting.optimization')->can('settings.edit');
    });

    Route::post('notification/read-all' , [\App\Http\Controllers\Admin\NotificationController::class , 'readAll'])->name('admin.notification.readAll');
    Route::prefix('lock-screen')
        ->name('lock-screen.')
        ->group(function () {
            Route::post('/', [LockScreenController::class, 'lock'])->name('lock');
            Route::get('/', [LockScreenController::class, 'show'])->name('show');
            Route::post('/unlock', [LockScreenController::class, 'unlock'])->name('unlock');
        });
});
