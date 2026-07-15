<?php

namespace Common\Services\Payment;

use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Common\Services\Exception\ExceptionLogger;
use Common\Services\Response\Responses;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use Common\Services\SalesProcess\OrderService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends BaseController
{
    public function __construct(protected OrderService $orderService , protected PaymentService $paymentService, protected Zarinpal $zarinpal) {}

    public function payment()
    {
        $order = Order::where('user_id', auth()->id())->where('order_status', 0)->first();
        return view('customer.payment.index', compact('order'));
    }

    public function couponDiscount(Request $request)
    {
        $request->validate([
            'coupon' => 'required'
        ], [
            'coupon.required' => 'لطفا کد تخفیف را وارد کنید.'
        ]);
        $status = $this->orderService->couponDiscount($request->coupon , auth()->id());
        return match ($status) {
            'USED_BEFORE' => Responses::redirectToWithBack(
                'info',
                'اطلاع رسانی',
                'شما قبلاً روی این سفارش کد تخفیف اعمال کرده‌اید.'
            ),
            'NOT_YOURS' => Responses::redirectToWithBack(
                'info',
                'اطلاع رسانی',
                'این کد تخفیف مختص شما نیست.'
            ),
            'SUCCESS' => Responses::redirectToWithBack(
                'success',
                'موفق',
                'کد تخفیف روی سفارش شما اعمال شد.'
            ),
            'FAILED' => Responses::redirectToWithBack(
                'warning',
                'هشدار',
                'کد تخفیف وجود ندارد.'
            ),
            default => Responses::redirectToWithBack(
                'warning',
                'هشدار',
                'خطایی در پردازش کد تخفیف به وجود آمده است.'
            ),
        };
    }

    public function paymentType(Request $request): RedirectResponse
    {
        $request->validate([
            'payment_type' => 'required|in:online,offline,cod'
        ], [
            'payment_type.required' => 'نحوه پرداخت را انتخاب کنید',
            'payment_type.in'       => 'نحوه پرداخت اشتباه می باشد',
        ]);

        $order = Order::where('user_id', auth()->id())
            ->where('order_status', 0)
            ->firstOrFail();

        $cartItems = CartItem::where('user_id', auth()->id())->get();
        try {
            DB::beginTransaction();
            $payment = $this->paymentService->createPayment(
                $request->payment_type,
                $order,
                $cartItems
            );
            DB::commit();
//            $cartItems->map(function ($cartItem) {
//               $this->changeProductStatus($cartItem->product_id, $cartItem->quantity);
//            });
        } catch (Exception $e) {
            DB::rollBack();
            ExceptionLogger::error($e, "Error in Payment Service");
        }

        if ($payment instanceof OnlinePayment) {
            return $this->redirectToGateway($payment);
        }

        if (! $payment) {
            return Responses::redirectToWith('customer.home', 'error','خطا', 'در ثبت سفارش خطایی رخ داد. لطفا دوباره تلاش کنید. لطفا سبد خود را خالی کنید و دوباره امتحان کنید');
        }

        return Responses::redirectToWith('customer.home', 'success','موفق', 'سفارش شما ثبت شد.');
    }

    public function redirectToGateway(mixed $payment): RedirectResponse
    {
        return redirect()->to(config('payment.zarinpal.sandboxGate').'/'.$payment->bank_first_response['data']['authority']);
    }

    public function callback(Order $order, Request $request): RedirectResponse
    {
        $authority = $request->input('Authority');
        $check = $this->zarinpal->verify($order, $authority);
        if ($request->input('Status') === 'OK') {
            if ($check['data']['code'] === 100) {
                $assesment = $this->paymentService->registerSuccessfulOrder($order, $check, $authority);
                if ($assesment) {
                    return Responses::redirectToWith('customer.home','success','موفق',Zarinpal::getErrorMessage($check['data']['code']));
                }
            } elseif ($check['data']['code'] === 101) {
                $assesment = $this->paymentService->checkForSuccessfulOrder($order, $check, $authority);
                if ($assesment) {
                    return Responses::redirectToWith('customer.home','info','اطلاع رسانی',Zarinpal::getErrorMessage($check['data']['code']));
                }
            }
        } else {
            $order->delete();
            return Responses::redirectToWith('customer.home','warning','هشدار','پرداخت کنسل شد');
        }
        $order->delete();
        return Responses::redirectToWith('customer.home','warning','هشدار','پرداخت کنسل شد');
    }

//    protected function changeProductStatus($product_id, $cartNumbers)
//    {
//        return Product::whereKey($product_id)
//            ->update([
//                'sold_out' => $cartNumbers,
//            ]);
//    }
}
