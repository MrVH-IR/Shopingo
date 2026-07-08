<?php

namespace Common\Services\Payment;

use App\Models\Market\CartItem;
use App\Models\Market\Coupon;
use App\Models\Market\Order;
use Common\Services\Payment\Requests\ChooseAddressAndDeliveryRequest;
use Common\Services\SalesProcess\OrderService;
use Illuminate\Http\Request;

class PaymentController extends BaseController
{
    public function __construct(protected OrderService $orderService) {}

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
        if ($status === "USED_BEFORE") {
            return redirect()->back()->with([
                'bootstrap-info' => [
                    'status' => 'پیغام',
                    'message' => 'شما قبلا روی این سفارش کد تخفیف اعمال کرده اید.'
                ]
            ]);
        } elseif ($status === "NOT_YOURS") {
            return redirect()->back()->with([
                'bootstrap-info' => [
                    'status' => 'پیغام',
                    'message' => 'این کد تخفیف مختص شما نمی باشد'
                ]
            ]);
        } elseif ($status === "SUCCESS") {
            return redirect()->back()->with([
                'bootstrap-success' => [
                    'status' => 'موفق',
                    'message' => 'کد تخفیف روی سفارش شما اعمال شد.'
                ]
            ]);
        } elseif ($status === "FAILED") {
            return redirect()->back()->with([
                'bootstrap-warning' => [
                    'status' => 'پیغام',
                    'message' => 'کد تخفیف وجود ندارد.'
                ]
            ]);
        }
        return redirect()->back()->with([
            'bootstrap-warning' => [
                'status' => 'خطا در پردازش',
                'message' => 'خطایی در پردازش مد تخفیف بوجود آمده است'
            ]
        ]);
    }
}
