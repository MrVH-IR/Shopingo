<?php

namespace Common\Controllers\SalesProcess;

use App\Models\Market\CartItem;
use App\Models\Market\Product;
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
    public function addToCart(CartRequest $request, Product $product)
    {
        try {
            $result = DB::transaction(function () use ($request, $product) {
                $color = $request->input('color');
                $guarantee = $request->input('guarantee');
                $cartItem = CartItem::query()
                    ->where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->where('color_id', $color)
                    ->where('guarantee_id', $guarantee)
                    ->lockForUpdate()
                    ->first();

                $currentQuantity = $cartItem?->numbers ?? 0;
                $newQuantity = $currentQuantity + $request->number;

                if ($newQuantity > $product->marketable_number) {
                    return false;
                }

                if ($cartItem) {
                    if ($cartItem->numbers !== $newQuantity) {
                        $cartItem->update([
                            'numbers' => $newQuantity,
                        ]);
                        $product->frozen_number += $newQuantity;
                        $product->save();
                    }

                    return true;
                }

                CartItem::create([
                    'user_id' => auth()->id(),
                    'product_id' => $product->id,
                    'color_id' => $color,
                    'guarantee_id' => $guarantee,
                    'numbers' => $request->number,
                ]);
                $product->frozen_number += $request->number;
                $product->save();
                return true;
            });
            if (!$result) {
                return back()->with([
                    'bootstrap-error' => [
                        'status' => 'خطا',
                        'message' => 'موجودی محصول مورد نظر به اتمام رسیده است.',
                        'link' => route('customer.home')
                    ]
                ]);
            }
            return back()->with([
                'bootstrap-success' => [
                    'status' => 'موفق',
                    'message' => 'محصول با موفقیت به سبد خرید شما اضافه شد. برای اتمام خرید به سبد خود بروید',
                    'link' => route('customer.sales-process.cart')
                ]
            ]);
        } catch (HttpException | ValidationException | QueryException $e) {
            $errorId = now()->format('YmdHis') . rand(1000, 9999);
            Log::error(
                "Exception During Cart Entry {$errorId}",
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
            return back()->with([
                'bootstrap-error' => [
                    'status' => 'خطا',
                    'message' => 'مشکلی در اضافه کردن محصول بوجود آمده است ' . $errorId . ' لطفا با ادمین تماس بگیرید.',
                    'link' => route('contact-us')
                ]
            ]);
        } catch (Throwable $e) {
            $errorId = now()->format('YmdHis') . rand(1000, 9999);
            Log::error(
                "Throwable Exception During Cart Entry {$errorId}",
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );
            return back()->with([
                'bootstrap-error' => [
                    'status' => 'خطا',
                    'message' => 'مشکلی در اضافه کردن محصول بوجود آمده است ' . $errorId . ' لطفا با ادمین تماس بگیرید.',
                    'link' => route('contact-us')
                ]
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => ['required', 'array'],
            'number.*' => ['required', 'integer', 'min:1', 'max:10'],
        ], [
            'number.required' => 'مقدار درخواستی محصول را وارد کنید.',
            'number.array' => 'اطلاعات محصول نامعتبر است.',

            'number.*.required' => 'تعداد محصول الزامی است.',
            'number.*.integer' => 'تعداد محصول باید عدد صحیح باشد.',
            'number.*.min' => 'حداقل تعداد محصول ۱ است.',
            'number.*.max' => 'حداکثر تعداد محصول ۱۰ است.',
            'number.*.exists' => 'سبد خرید مورد نظر پیدا نشد'
        ]);
        $validator->after(function ($validator) use ($request) {
            foreach (array_keys($request->input('number', [])) as $id) {
                if (!CartItem::whereKey($id)->exists()) {
                    $validator->errors()->add("number.$id", 'سبد خرید نامعتبر است.');
                }
            }
        });

        $validated = $validator->validate();
        $numbers = $validated['number'];

        CartItem::where('user_id', auth()->id())
            ->whereIn('id', array_keys($numbers))
            ->get()
            ->each(function (CartItem $item) use ($numbers) {
                $item->update([
                    'numbers' => $numbers[$item->id],
                ]);
            });
        return redirect()->route('customer.sales-process.address-and-delivery');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        abort_if($cartItem->user_id !== auth()->id(), 403);

        $cartItem->forceDelete();

        return back()->with([
            'bootstrap-success' => [
                'status' => 'موفق',
                'message' => 'محصول با موفقیت حذف شد.',
            ]
        ]);
    }

    public function cart()
    {
        $cartItems = CartItem::query()
            ->where('user_id', auth()->id())
            ->get();
        $relatedProducts = Product::all();
        return view('customer.sales-process.cart', compact('cartItems', 'relatedProducts'));
    }
}
