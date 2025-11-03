<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{AdminDashboardController,
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
    Market\StoreController,
    Content\CategoryController as ContentCategoryController,
    Content\CommentController as ContentCommentController,
    Content\FAQController,
    Content\MenuController,
    Content\PageController,
    Content\PostController,
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

Route::prefix( '/admin')->namespace('Admin')->group(function() {
    Route::get('/' , [AdminDashboardController::class , 'index'])->name('admin.home');

    Route::prefix('market')->namespace('Market')->group(function() {
        //Category
        Route::prefix('category')->group(function() {
            Route::get('/' , [CategoryController::class , 'index'])->name('admin.market.category.index');
            Route::get('/create' , [CategoryController::class , 'create'])->name('admin.market.category.create');
            Route::post('/store' , [CategoryController::class , 'store'])->name('admin.market.category.store');
            Route::get('/edit/{productCategory}' , [CategoryController::class , 'edit'])->name('admin.market.category.edit');
            Route::put('/update/{productCategory}' , [CategoryController::class , 'update'])->name('admin.market.category.update');
            Route::delete('/destroy/{productCategory}' , [CategoryController::class , 'destroy'])->name('admin.market.category.destroy');
            // Route::resource('/' , CategoryController::class); // Can Be used And Delete All Those Above For (Category).
        });
        //Brand
        Route::prefix('brand')->group(function() {
            Route::get('/' , [BrandController::class , 'index'])->name('admin.market.brand.index');
            Route::get('/create' , [BrandController::class , 'create'])->name('admin.market.brand.create');
            Route::post('/store' , [BrandController::class , 'store'])->name('admin.market.brand.store');
            Route::get('/edit/{brand}' , [BrandController::class , 'edit'])->name('admin.market.brand.edit');
            Route::put('/update/{brand}' , [BrandController::class , 'update'])->name('admin.market.brand.update');
            Route::delete('/destroy/{brand}' , [BrandController::class , 'destroy'])->name('admin.market.brand.destroy');
            Route::get('/status/{brand}' , [BrandController::class , 'status'])->name('admin.market.brand.status');
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
            Route::get('/edit/{delivery}' , [DeliveryController::class , 'edit'])->name('admin.market.delivery.edit');
            Route::put('/update/{delivery}' , [DeliveryController::class , 'update'])->name('admin.market.delivery.update');
            Route::delete('/destroy/{delivery}' , [DeliveryController::class , 'destroy'])->name('admin.market.delivery.destroy');
            Route::get('/status/{delivery}' , [DeliveryController::class , 'status'])->name('admin.market.delivery.status');
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
            Route::get('/edit/{product}' , [ProductController::class , 'edit'])->name('admin.market.product.edit');
            Route::put('/update/{product}' , [ProductController::class , 'update'])->name('admin.market.product.update');
            Route::delete('/destroy/{product}' , [ProductController::class , 'destroy'])->name('admin.market.product.destroy');
            Route::get('/status{product}' , [ProductController::class , 'status'])->name('admin.market.product.status');

            //colors
            Route::get('/color/{product}' , [ProductColorController::class , 'index'])->name('admin.market.color.index');
            Route::get('/color/{product}/create' , [ProductColorController::class , 'create'])->name('admin.market.color.create');
            Route::post('/color/{product}/store' , [ProductColorController::class , 'store'])->name('admin.market.color.store');
            Route::delete('/color/destroy/{product}/{color}' , [ProductColorController::class , 'destroy'])->name('admin.market.color.destroy');
            //Gallery
            Route::get('/gallery/{product}' , [GalleryController::class , 'index'])->name('admin.market.gallery.index');
            Route::get('/gallery/create/{product}' , [GalleryController::class , 'create'])->name('admin.market.gallery.create');
            Route::post('/gallery/store/{product}' , [GalleryController::class , 'store'])->name('admin.market.gallery.store');
            Route::delete('/gallery/destroy/{product}/{productImage}' , [GalleryController::class , 'destroy'])->name('admin.market.gallery.destroy');

            Route::get('/gallery/change-size/{productImage}' , [GalleryController::class , 'changeSize'])->name('admin.market.gallery.changeSize');
            // Route::resource('/' , ProductController::class); // Can Be used And Delete All Those Above For (Brand).
        });
        //Property
        Route::prefix('property')->group(function() {
            Route::get('/' , [PropertyController::class , 'index'])->name('admin.market.property.index');
            Route::get('/create' , [PropertyController::class , 'create'])->name('admin.market.property.create');
            Route::post('/store' , [PropertyController::class , 'store'])->name('admin.market.property.store');
            Route::get('/edit/{categoryAttribute}' , [PropertyController::class , 'edit'])->name('admin.market.property.edit');
            Route::put('/update/{categoryAttribute}' , [PropertyController::class , 'update'])->name('admin.market.property.update');
            Route::delete('/destroy/{categoryAttribute}' , [PropertyController::class , 'destroy'])->name('admin.market.property.destroy');
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
            Route::get('/' , [ContentCategoryController::class , 'index'])->name('admin.content.category.index');
            Route::get('/create' , [ContentCategoryController::class , 'create'])->name('admin.content.category.create');
            Route::post('/store' , [ContentCategoryController::class , 'store'])->name('admin.content.category.store');
            Route::get('/edit/{postCategory}' , [ContentCategoryController::class , 'edit'])->name('admin.content.category.edit');
            Route::put('/update/{postCategory}' , [ContentCategoryController::class , 'update'])->name('admin.content.category.update');
            Route::delete('/destroy/{postCategory}' , [ContentCategoryController::class , 'destroy'])->name('admin.content.category.destroy');
            Route::get('/status/{postCategory}' , [ContentCategoryController::class , 'status'])->name('admin.content.category.status');
            // Route::resource('/' , ContentCategoryController::class); // Can Be used And Delete All Those Above For (Category).
        });
        //Comment
        Route::prefix('comment')->group(function() {
            Route::get('/' , [ContentCommentController::class , 'index'])->name('admin.content.comment.index');
            Route::get('/show/{comment}' , [ContentCommentController::class , 'show'])->name('admin.content.comment.show');
            Route::get('/status/{comment}', [ContentCommentController::class , 'status'])->name('admin.content.comment.status');
            Route::post('/approved/{comment}', [ContentCommentController::class , 'approved'])->name('admin.content.comment.approved');
            Route::post('/answer/{comment}', [ContentCommentController::class , 'answer'])->name('admin.content.comment.answer');
        });
        //FAQ
        Route::prefix('faq')->group(function() {
            Route::get('/' , [FAQController::class , 'index'])->name('admin.content.faq.index');
            Route::get('/create' , [FAQController::class , 'create'])->name('admin.content.faq.create');
            Route::post('/store' , [FAQController::class , 'store'])->name('admin.content.faq.store');
            Route::get('/edit/{faq}' , [FAQController::class , 'edit'])->name('admin.content.faq.edit');
            Route::put('/update/{faq}' , [FAQController::class , 'update'])->name('admin.content.faq.update');
            Route::delete('/destroy/{faq}' , [FAQController::class , 'destroy'])->name('admin.content.faq.destroy');
            Route::get('/status/{faq}' , [FAQController::class , 'status'])->name('admin.content.faq.status');
            // Route::resource('/' , FAQController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Menu
        Route::prefix('menu')->group(function() {
            Route::get('/' , [MenuController::class , 'index'])->name('admin.content.menu.index');
            Route::get('/create' , [MenuController::class , 'create'])->name('admin.content.menu.create');
            Route::post('/store' , [MenuController::class , 'store'])->name('admin.content.menu.store');
            Route::get('/edit/{menu}' , [MenuController::class , 'edit'])->name('admin.content.menu.edit');
            Route::put('/update/{menu}' , [MenuController::class , 'update'])->name('admin.content.menu.update');
            Route::delete('/destroy/{menu}' , [MenuController::class , 'destroy'])->name('admin.content.menu.destroy');
            Route::get('/status/{menu}' , [MenuController::class , 'status'])->name('admin.content.menu.status');
            // Route::resource('/' , MenuController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Page
        Route::prefix('page')->group(function() {
            Route::get('/' , [PageController::class , 'index'])->name('admin.content.page.index');
            Route::get('/create' , [PageController::class , 'create'])->name('admin.content.page.create');
            Route::post('/store' , [PageController::class , 'store'])->name('admin.content.page.store');
            Route::get('/edit/{page}' , [PageController::class , 'edit'])->name('admin.content.page.edit');
            Route::put('/update/{page}' , [PageController::class , 'update'])->name('admin.content.page.update');
            Route::delete('/destroy/{page}' , [PageController::class , 'destroy'])->name('admin.content.page.destroy');
            Route::get('/status/{page}' , [PageController::class , 'status'])->name('admin.content.page.status');
            // Route::resource('/' , PageController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Post
        Route::prefix('post')->group(function() {
            Route::get('/' , [PostController::class , 'index'])->name('admin.content.post.index');
            Route::get('/create' , [PostController::class , 'create'])->name('admin.content.post.create');
            Route::post('/store' , [PostController::class , 'store'])->name('admin.content.post.store');
            Route::get('/edit/{post}' , [PostController::class , 'edit'])->name('admin.content.post.edit');
            Route::put('/update/{post}' , [PostController::class , 'update'])->name('admin.content.post.update');
            Route::delete('/destroy/{post}' , [PostController::class , 'destroy'])->name('admin.content.post.destroy');
            Route::get('/status/{post}' , [PostController::class , 'status'])->name('admin.content.post.status');
            Route::get('/commentable/{post}' , [PostController::class , 'commentable'])->name('admin.content.post.commentable');
            // Route::resource('/' , PostController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
    //User Prefix
    Route::prefix('user')->namespace('User')->group(function () {
        //Admin
        Route::prefix('admin-user')->group(function() {
            Route::get('/' , [AdminUserController::class , 'index'])->name('admin.user.admin-user.index');
            Route::get('/create' , [AdminUserController::class , 'create'])->name('admin.user.admin-user.create');
            Route::post('/store' , [AdminUserController::class , 'store'])->name('admin.user.admin-user.store');
            Route::get('/edit/{user}' , [AdminUserController::class , 'edit'])->name('admin.user.admin-user.edit');
            Route::put('/update/{user}' , [AdminUserController::class , 'update'])->name('admin.user.admin-user.update');
            Route::delete('/destroy/{id}' , [AdminUserController::class , 'destroy'])->name('admin.user.admin-user.destroy');
            Route::get('/activation/{user}' , [AdminUserController::class , 'activation'])->name('admin.user.admin-user.activation');
            Route::get('/status/{user}' , [AdminUserController::class , 'status'])->name('admin.user.admin-user.status');
            // Route::resource('/' , AdminUserController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Customer
        Route::prefix('customer')->group(function() {
            Route::get('/' , [CustomerController::class , 'index'])->name('admin.user.customer.index');
            Route::get('/create' , [CustomerController::class , 'create'])->name('admin.user.customer.create');
            Route::post('/store' , [CustomerController::class , 'store'])->name('admin.user.customer.store');
            Route::get('/edit/{user}' , [CustomerController::class , 'edit'])->name('admin.user.customer.edit');
            Route::put('/update/{user}' , [CustomerController::class , 'update'])->name('admin.user.customer.update');
            Route::delete('/destroy/{id}' , [CustomerController::class , 'destroy'])->name('admin.user.customer.destroy');
            Route::get('/status/{user}' , [CustomerController::class , 'status'])->name('admin.user.customer.status');
            Route::get('/activation/{user}' , [CustomerController::class , 'activation'])->name('admin.user.customer.activation');
            // Route::resource('/' , CustomerController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Role
        Route::prefix('role')->group(function() {
            Route::get('/' , [RoleController::class , 'index'])->name('admin.user.role.index');
            Route::get('/create' , [RoleController::class , 'create'])->name('admin.user.role.create');
            Route::post('/store' , [RoleController::class , 'store'])->name('admin.user.role.store');
            Route::get('/edit/{role}' , [RoleController::class , 'edit'])->name('admin.user.role.edit');
            Route::put('/update/{role}' , [RoleController::class , 'update'])->name('admin.user.role.update');
            Route::delete('/destroy/{role}' , [RoleController::class , 'destroy'])->name('admin.user.role.destroy');
            Route::get('/status/{role}' , [RoleController::class , 'status'])->name('admin.user.role.status');
            // Route::resource('/' , RoleController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //Permission
        Route::prefix('permission')->group(function() {
            Route::get('/' , [PermissionController::class , 'index'])->name('admin.user.permission.index');
            Route::get('/create' , [PermissionController::class , 'create'])->name('admin.user.permission.create');
            Route::post('/store' , [PermissionController::class , 'store'])->name('admin.user.permission.store');
            Route::get('/edit/{id}' , [PermissionController::class , 'edit'])->name('admin.user.permission.edit');
            Route::put('/update/{id}' , [PermissionController::class , 'update'])->name('admin.user.permission.update');
            Route::delete('/destroy/{id}' , [PermissionController::class , 'destroy'])->name('admin.user.permission.destroy');
            // Route::resource('/' , PermissionController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
    //Notification
    Route::prefix('notification')->namespace('Notification')->group(function () {
        Route::prefix('email')->group(function () {
            //Email
            Route::get('/' , [EmailController::class , 'index'])->name('admin.email.index');
            Route::get('/create' , [EmailController::class , 'create'])->name('admin.email.create');
            Route::post('/store' , [EmailController::class , 'store'])->name('admin.email.store');
            Route::get('/edit/{email}' , [EmailController::class , 'edit'])->name('admin.email.edit');
            Route::put('/update/{email}' , [EmailController::class , 'update'])->name('admin.email.update');
            Route::delete('/destroy/{email}' , [EmailController::class , 'destroy'])->name('admin.email.destroy');
            Route::get('/status/{email}' , [EmailController::class , 'status'])->name('admin.email.status');
            Route::get('/file/{file}' , [EmailController::class , 'downloadFile'])->name('admin.email.file.download');
            Route::get('/file/view/{email}' , [EmailController::class , 'viewFile'])->name('admin.email.file.view');
            Route::delete('/email/file/delete/{emailFile}', [EmailController::class, 'deleteFile'])->name('admin.email.file.delete');
            // Route::resource('/' , EmailController::class); // Can Be used And Delete All Those Above For (Comment).
        });
        //SMS
        Route::prefix('sms')->group(function () {
            Route::get('/' , [SMSController::class , 'index'])->name('admin.sms.index');
            Route::get('/create' , [SMSController::class , 'create'])->name('admin.sms.create');
            Route::post('/store' , [SMSController::class , 'store'])->name('admin.sms.store');
            Route::get('/edit/{sms}' , [SMSController::class , 'edit'])->name('admin.sms.edit');
            Route::put('/update/{sms}' , [SMSController::class , 'update'])->name('admin.sms.update');
            Route::delete('/destroy/{sms}' , [SMSController::class , 'destroy'])->name('admin.sms.destroy');
            Route::get('/status/{sms}' , [SMSController::class , 'status'])->name('admin.sms.status');
            // Route::resource('/' , SmsController::class); // Can Be used And Delete All Those Above For (Comment).
        });
    });
    Route::prefix('ticket')->namespace('Ticket')->group(function () {

        Route::prefix('category')->group(function () {
            Route::get('/' , [TicketCategoryController::class , 'index'])->name('admin.ticket.category.index');
            Route::get('/create' , [TicketCategoryController::class , 'create'])->name('admin.ticket.category.create');
            Route::post('/store' , [TicketCategoryController::class , 'store'])->name('admin.ticket.category.store');
            Route::get('/edit/{ticketCategory}' , [TicketCategoryController::class , 'edit'])->name('admin.ticket.category.edit');
            Route::put('/update/{ticketCategory}' , [TicketCategoryController::class , 'update'])->name('admin.ticket.category.update');
            Route::delete('/destroy/{ticketCategory}' , [TicketCategoryController::class , 'destroy'])->name('admin.ticket.category.destroy');
            Route::get('/status/{ticketCategory}' , [TicketCategoryController::class , 'status'])->name('admin.ticket.category.status');
        });

        Route::prefix('priority')->group(function () {
            Route::get('/' , [TicketPriorityController::class , 'index'])->name('admin.ticket.priority.index');
            Route::get('/create' , [TicketPriorityController::class , 'create'])->name('admin.ticket.priority.create');
            Route::post('/store' , [TicketPriorityController::class , 'store'])->name('admin.ticket.priority.store');
            Route::get('/edit/{ticketPriority}' , [TicketPriorityController::class , 'edit'])->name('admin.ticket.priority.edit');
            Route::put('/update/{ticketPriority}' , [TicketPriorityController::class , 'update'])->name('admin.ticket.priority.update');
            Route::delete('/destroy/{ticketPriority}' , [TicketPriorityController::class , 'destroy'])->name('admin.ticket.priority.destroy');
            Route::get('/status/{ticketPriority}' , [TicketPriorityController::class , 'status'])->name('admin.ticket.priority.status');
        });

        Route::prefix('admin')->group(function () {
            Route::get('/' , [TicketAdminController::class , 'index'] )->name('admin.ticket.admin.index');
            Route::get('/set/{admin}' , [TicketAdminController::class , 'set'])->name('admin.ticket.admin.set');
        });
        //Main
        Route::get('/' , [TicketController::class , 'index'])->name('admin.ticket.index');
        Route::get('/new-tickets' , action: [TicketController::class , 'newTickets'])->name('admin.ticket.newtickets');
        Route::get('/open-tickets' , [TicketController::class , 'openTickets'])->name('admin.ticket.opentickets');
        Route::get('/close-tickets' , [TicketController::class , 'closeTickets'])->name('admin.ticket.closetickets');
        Route::get('/create' , [TicketController::class , 'create'])->name('admin.ticket.create');
        Route::get('/show{ticket}' , [TicketController::class , 'show'])->name('admin.ticket.show');
        Route::post('/answer/{ticket}' , [TicketController::class , 'answer'])->name('admin.ticket.answer');
        Route::get('/change/{ticket}' , [TicketController::class , 'change'])->name('admin.ticket.change');
    });

    Route::prefix('setting')->namespace('Setting')->group(function() {
            Route::get('/' , [SettingController::class , 'index'])->name('admin.setting.index');
            Route::get('/edit/{setting}' , [SettingController::class , 'edit'])->name('admin.setting.edit');
            Route::put('/update/{setting}' , [SettingController::class , 'update'])->name('admin.setting.update');
    });
});





