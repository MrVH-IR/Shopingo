<?php

use App\Http\Controllers\Auth\Customer\LoginRegisterController;
use App\Http\Controllers\Security\SecurityController;
use Common\Services\{Home\HomeController,
    Market\ProductController,
    Profile\FavoriteController,
    Profile\OrderController,
    Profile\ProfileController as UserProfileController,
    Profile\AddressController as UserProfileAddressController,
    Profile\TicketController,
    SalesProcess\AddressController,
    SalesProcess\CartController,
    SalesProcess\ProfileController,
    Payment\PaymentController,
    Products\ProductController as CustomerProductController
};
use Illuminate\Support\Facades\Route;

Route::get('/verify-human', [SecurityController::class, 'show'])
    ->name('verify-human');

Route::post('/verify-human', [SecurityController::class, 'verify'])
    ->name('verify-human.check');

Route::get('/', [HomeController::class , 'index'])->middleware('turnstile')->name('customer.home');

// Information
Route::get('/about-us', function () {
    return view('informations.about');
});

Route::get('/contact-us', function () {
    return view('informations.contact');
})->name('contact-us');

Route::get('/partnership', function() {
    return view('informations.partnership');
});
Route::get('/privacy-policy', function() {
    return view('informations.privacy');
});
Route::get('/faq', function() {
    $faqs = \App\Models\Content\FAQ::where('status', 1)->paginate(10);
    return view('informations.faq', compact('faqs'));
});
// End Information Route

Route::namespace('Auth')->middleware('throttle:20,1', 'turnstile')->group(function () {
    Route::get('/login-register' , [LoginRegisterController::class , 'loginRegisterForm'])->name('auth.customer.login-register-form');
    Route::post('/login-register' , [LoginRegisterController::class , 'loginRegister'])->name('auth.customer.login-register');
    Route::get('/login-confirm/{token}' , [LoginRegisterController::class , 'loginConfirmForm'])->name('auth.customer.login-confirm-form');
    Route::post('/login-confirm/{token}' ,  [LoginRegisterController::class , 'loginConfirm'])->name('auth.customer.login-confirm');
    Route::post('/logout' , [LoginRegisterController::class , 'logout'])->name('auth.customer.logout');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'turnstile'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Market
Route::prefix('market')
    ->name('customer.market.')
    ->middleware('throttle:50,5', 'turnstile')
    ->group(function () {
        Route::get('/product/{product:slug}', [ProductController::class, 'product'])->name('product');
        Route::post('/add-comment/product/{product:slug}', [ProductController::class, 'addComment'])->name('add-comment');
        Route::middleware('auth')->group(function () {
            Route::post('/favorite/{product:slug}', [ProductController::class, 'toggleFavorite'])->name('product.favorite');
            Route::post('/compare-product/{product:slug}', [ProductController::class, 'compareProduct'])->name('product.compare');
        });
});
// Sales process
Route::prefix('market')
    ->name('customer.sales-process.')
    ->middleware('auth', 'turnstile')
    ->group(function () {
        Route::get('/cart' , [CartController::class , 'cart'])->name('cart');
        Route::post('/cart' , [CartController::class , 'updateCart'])->name('update-cart');
        Route::post('/add-to-cart/{product:slug}' , [CartController::class , 'addToCart'])->name('add-to-cart');
        Route::delete('/remove-from-cart/{cartItem}' , [CartController::class, 'removeFromCart'])->name('remove-from-cart');
        Route::middleware('profile-complete')->group(function () {
            Route::get('address-and-delivery', [AddressController::class , 'addressAndDelivery'])->name('address-and-delivery');
            Route::get('/payment', [PaymentController::class , 'payment'])->name('payment');
            Route::post('/payment-type', [PaymentController::class , 'paymentType'])->name('payment-type');
            Route::post('/choose-address-and-delivery', [AddressController::class , 'chooseAddressAndDelivery'])->name('choose-address-and-delivery');
            Route::post('/coupon-discount', [PaymentController::class , 'couponDiscount'])->name('coupon-discount');
        });
        Route::post('/add-address', [AddressController::class , 'addAddress'])->name('add-address');
        Route::put('/update-address', [AddressController::class , 'updateAddress'])->name('update-address');
        Route::get('/get-cities/{province}', [AddressController::class , 'getCities'])->name('get-cities');
        Route::any('/zarinpal-callback/{order}/', [PaymentController::class , 'callback'])->name('zarinpal-callback');
        Route::get('/complete-profile' , [ProfileController::class , 'profile'])->name('profile-complete');
        Route::post('complete-profile' , [ProfileController::class , 'updateProfile'])->name('profile.update');
});

Route::prefix('profile')
    ->name('customer.profile.')
    ->middleware('auth', 'turnstile')
    ->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/my-favorites', [FavoriteController::class, 'index'])->name('my-favorites');
        Route::delete('/favorite-delete/{product}', [FavoriteController::class, 'delete'])->name('favorite-delete');
        Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
        Route::put('/profile/update', [UserProfileController::class, 'update'])->name('profile.update');
        Route::get('/my-addresses', [UserProfileAddressController::class, 'index'])->name('my-addresses');
        Route::delete('/delete-address/{address}', [UserProfileAddressController::class, 'deleteAddress'])->name('delete-address');
        Route::get('/my-tickets', [TicketController::class, 'index'])->name('my-tickets');
        Route::post('/send-ticket', [TicketController::class, 'sendTicket'])->name('send-ticket');
    });

Route::prefix('products')
    ->name('products.')
    ->middleware('turnstile')
    ->group(function () {
        Route::get('/{category?}', [CustomerProductController::class, 'index'])->name('products');
        Route::get('/search', [CustomerProductController::class, 'search'])->name('search');
    });
