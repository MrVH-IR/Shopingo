<?php

namespace Common\Services\SalesProcess;

use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Common\Services\SalesProcess\Request\CartRequest;
use HttpException;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Throwable;

class CartController extends BaseController
{

    /**
     * @param CartRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function addToCart(
        CartRequest $request,
        Product $product,
        StockService $stockService
    ): RedirectResponse
    {
        try {
            $result = DB::transaction(function () use (
                $request,
                $product,
                $stockService
            ) {
                //locking the product before changing its reservation.
                $lockedProduct = Product::query()
                    ->whereKey($product->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $color = $request->input('color');
                $guarantee = $request->input('guarantee');

                $cartItem = CartItem::query()
                    ->where('user_id', auth()->id())
                    ->where('product_id', $lockedProduct->id)
                    ->where('color_id', $color)
                    ->where('guarantee_id', $guarantee)
                    ->lockForUpdate()
                    ->first();

                $currentQuantity = (int) ($cartItem?->numbers ?? 0);
                $newQuantity = $currentQuantity + (int) $request->number;

                if ($newQuantity > 10) {
                    return false;
                }

                $delta = $newQuantity - $currentQuantity;

                if (!$stockService->adjustReservation($lockedProduct, $delta)) {
                    return false;
                }

                if ($cartItem) {
                    $cartItem->update([
                        'numbers' => $newQuantity,
                    ]);
                } else {
                    CartItem::create([
                        'user_id' => auth()->id(),
                        'product_id' => $lockedProduct->id,
                        'color_id' => $color,
                        'guarantee_id' => $guarantee,
                        'numbers' => $newQuantity,
                    ]);
                }

                return true;
            });

            if (!$result) {
                return back()->with([
                    'bootstrap-error' => [
                        'status' => 'خطا',
                        'message' => 'موجودی محصول مورد نظر کافی نیست.',
                        'link' => route('customer.home'),
                    ],
                ]);
            }

            return back()->with([
                'bootstrap-success' => [
                    'status' => 'موفق',
                    'message' => 'محصول با موفقیت به سبد خرید اضافه شد.',
                    'link' => route('customer.sales-process.cart'),
                ],
            ]);

        } catch (Throwable $e) {
            $errorId = now()->format('YmdHis') . random_int(1000, 9999);

            Log::error("Cart entry failed: {$errorId}", [
                'exception' => $e,
            ]);

            return back()->with([
                'bootstrap-error' => [
                    'status' => 'خطا',
                    'message' => "مشکلی در اضافه کردن محصول رخ داده است. کد پیگیری: {$errorId}",
                    'link' => route('contact-us'),
                ],
            ]);
        }
    }


    public function updateCart(Request $request, StockService $stockService): RedirectResponse
    {
        $validated = $request->validate([
            'number' => ['required', 'array', 'min:1'],
            'number.*' => ['required', 'integer', 'min:1', 'max:10'],
        ], [
            'number.required' => 'مقدار درخواستی محصول را وارد کنید.',
            'number.array' => 'اطلاعات محصول نامعتبر است.',
            'number.min' => 'حداقل یک محصول باید در سبد خرید وجود داشته باشد.',

            'number.*.required' => 'تعداد محصول الزامی است.',
            'number.*.integer' => 'تعداد محصول باید عدد صحیح باشد.',
            'number.*.min' => 'حداقل تعداد محصول ۱ است.',
            'number.*.max' => 'حداکثر تعداد محصول ۱۰ است.',
        ]);

        $numbers = $validated['number'];
        $cartItemIds = array_keys($numbers);
        $userId = auth()->id();

        DB::transaction(function () use (
            $numbers,
            $cartItemIds,
            $userId,
            $stockService
        ) {
            // Read cart items to discover their product IDs.
            $initialItems = CartItem::query()
                ->where('user_id', $userId)
                ->whereIn('id', $cartItemIds)
                ->get();

            // Reject missing items and items owned by another user.
            if ($initialItems->count() !== count($cartItemIds)) {
                throw ValidationException::withMessages([
                    'number' => 'یک یا چند محصول در سبد خرید معتبر نیستند.',
                ]);
            }

            $productIds = $initialItems
                ->pluck('product_id')
                ->unique()
                ->sort()
                ->values();

            // Lock products first, in a deterministic order.
            $products = Product::query()
                ->whereIn('id', $productIds)
                ->orderBy('id')
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Then lock cart items.
            $cartItems = CartItem::query()
                ->where('user_id', $userId)
                ->whereIn('id', $cartItemIds)
                ->lockForUpdate()
                ->get();

            if ($cartItems->count() !== count($cartItemIds)) {
                throw ValidationException::withMessages([
                    'number' => 'سبد خرید تغییر کرده است. صفحه را مجدداً بارگذاری کنید.',
                ]);
            }

            foreach ($cartItems as $item) {
                $product = $products->get($item->product_id);

                if (!$product) {
                    throw ValidationException::withMessages([
                        'number' => 'محصول مورد نظر دیگر موجود نیست.',
                    ]);
                }

                $oldQuantity = (int) $item->numbers;
                $newQuantity = (int) $numbers[$item->id];

                $delta = $newQuantity - $oldQuantity;

                if (!$stockService->adjustReservation($product, $delta)) {
                    throw ValidationException::withMessages([
                        "number.{$item->id}" => "موجودی محصول {$product->name} کافی نیست.",
                    ]);
                }

                $item->update([
                    'numbers' => $newQuantity,
                ]);
            }
        });

        return redirect()->route('customer.sales-process.address-and-delivery');
    }

    public function removeFromCart(
        CartItem $cartItem,
        StockService $stockService
    ): RedirectResponse
    {
        DB::transaction(function () use ($cartItem, $stockService) {
            // Verify ownership and get the product ID.
            $initialItem = CartItem::query()
                ->whereKey($cartItem->id)
                ->where('user_id', auth()->id())
                ->first();

            abort_if(!$initialItem, 404);

            // Lock product first.
            $product = Product::query()
                ->whereKey($initialItem->product_id)
                ->lockForUpdate()
                ->firstOrFail();

            // Then lock cart item.
            $lockedItem = CartItem::query()
                ->whereKey($initialItem->id)
                ->where('user_id', auth()->id())
                ->lockForUpdate()
                ->firstOrFail();

            // Release all reserved quantities.
            $stockService->adjustReservation(
                $product,
                -(int) $lockedItem->numbers
            );

            $lockedItem->forceDelete();
        });

        return back()->with([
            'bootstrap-success' => [
                'status' => 'موفق',
                'message' => 'محصول با موفقیت حذف شد.',
            ],
        ]);
    }

    public function cart()
    {
        $cartItems = CartItem::query()
            ->where('user_id', auth()->id())
            ->get();
        $productIds = $cartItems->pluck('product_id');

        $relatedProducts = $productIds->isNotEmpty()
            ? Product::whereIn('id', $productIds)->get()
            : Product::inRandomOrder()->take(20)->get();
        return view('customer.sales-process.cart', compact('cartItems', 'relatedProducts'));
    }
}
