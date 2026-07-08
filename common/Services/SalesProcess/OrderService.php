<?php

namespace Common\Services\SalesProcess;

use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Coupon;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;
use function Laravel\Prompts\select;

class OrderService
{

    protected const string NOT_YOURS = 'NOT_YOURS';
    protected const string SUCCESS = 'SUCCESS';
    protected const string USED_BEFORE = 'USED_BEFORE';
    protected const string FAILED = 'FAILED';

    /**
     * @param $user_id
     * @param $address_id
     * @param $delivery_id
     * @return array|false|mixed
     * @throws Throwable
     */
    public function createPendingOrder($user_id , $address_id , $delivery_id): mixed
    {
        try {
            return DB::transaction(function () use ($user_id , $address_id , $delivery_id) {
                $cartItems = CartItem::where('user_id' , $user_id)->get();
                $totalFinalPrice = 0;
                $totalFinalDiscountWithNumber = 0;
                $deliveryAmount = Delivery::whereKey($delivery_id)->value('amount');
                foreach ($cartItems as $cartItem) {
                    $totalFinalPrice += $cartItem->cartItemFinalPrice();
                    $totalFinalDiscountWithNumber += $cartItem->cartItemFinalDiscount();
                }
                $commonDiscount = CommonDiscount::active()->first();
                if ($commonDiscount) {
                    $commonPercentageDiscountAmount = $totalFinalPrice * ($commonDiscount->discount / 100);
                    if ($commonPercentageDiscountAmount > $commonDiscount->discount_ceiling) {
                        $commonPercentageDiscountAmount = $commonDiscount->discount_ceiling;
                    }
                    if ($totalFinalPrice >= $commonDiscount->discount_floor) {
                        $finalPrice = $totalFinalPrice - $commonPercentageDiscountAmount;
                    } else {
                        $finalPrice = $totalFinalPrice;
                    }
                } else {
                    $finalPrice = $totalFinalPrice;
                }

                Order::updateOrCreate([
                    'user_id' => $user_id , 'order_status' => 0
                ], [
                    'address_id' => $address_id,
                    'delivery_id' => $delivery_id,
                    'delivery_amount' => $deliveryAmount,
                    'order_final_amount' => $finalPrice,
                    'order_discount_amount' => $totalFinalDiscountWithNumber,
                    'common_discount_id' => $commonDiscount->id ?? null,
                    'order_common_discount_amount' => $commonPercentageDiscountAmount ?? 0,
                    'order_total_products_discounts_amount' => $totalFinalDiscountWithNumber + ($commonPercentageDiscountAmount ?? 0),
                ]);

                return [
                    'status' => true,
                    'finalPrice' => $finalPrice,
                    'delivery_amount' => $deliveryAmount,
                    'totalFinalDiscountWithNumber' => $totalFinalDiscountWithNumber,
                    'commonPercentageDiscountAmount' => $commonPercentageDiscountAmount ?? 0,
                ];
            });
        } catch (Throwable $th) {
            $errorId = now()->format('YmdHis') . rand(1000, 9999);
            Log::error(
                "OrderService Error",
                [
                    'user_id'=> $user_id,
                    'exception'=> $th
                ]
            );
            return false;
        }
    }


    /**
     * @param $coupon
     * @param $user_id
     * @return string
     */
    public function couponDiscount($coupon , $user_id): string
    {
        $coupon = $this->findCouponByCode($coupon);
        if (!$coupon) {
            return self::FAILED;
        }

        if ($coupon->user_id !== null && $coupon->user_id != $user_id) {
            return self::NOT_YOURS;
        }

        $order = $this->findCouponlessOrder($user_id);

        if (!$order) {
            return self::USED_BEFORE;
        }

        $this->setCouponToOrder($order, $coupon);

        return self::SUCCESS;
    }

    protected function findCouponByCode($code): ?Coupon
    {
        return Coupon::active()
            ->where('code', $code)
            ->first();
    }

    protected function findCouponlessOrder($user_id): ?Order
    {
        return Order::couponlessOrders()
            ->where('user_id', $user_id)
            ->first();
    }

    protected function setCouponToOrder(Order $order , Coupon $coupon): void
    {
        if ($coupon->amount_type === 0) {
            $couponDiscountAmount = $order->order_final_amount * ($coupon->amount / 100);
            if ($couponDiscountAmount > $coupon->discount_ceiling) {
                $couponDiscountAmount = $coupon->discount_ceiling;
            }
        } else {
            $couponDiscountAmount = $coupon->amount;
        }

        $order->order_final_amount = $order->order_final_amount - $couponDiscountAmount;
        $order->order_coupon_discount_amount = $couponDiscountAmount;
        $order->order_total_products_discounts_amount += $couponDiscountAmount;
        $order->coupon_id = $coupon->id;
        $order->save();
    }
}
