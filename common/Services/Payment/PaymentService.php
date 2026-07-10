<?php

namespace Common\Services\Payment;

use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Delivery;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use App\Models\Market\Payment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Throwable;

class PaymentService
{
    public function __construct(protected Zarinpal $zarinpal) {}
    public function createPayment(string $type, Order $order, Collection $cartItems): mixed
    {
        try {
            $result = match ($type) {
                'online'  => $this->onlinePayment($order),
                'offline' => $this->offlinePayment($order),
                'cod'     => $this->codPayment($order),
                default   => false,
            };

            if (! $result) {
                return false;
            }

            $order->update([
                'payment_type' => $this->paymentTypeCode($type),
                'order_status' => 1,
            ]);

            $this->payment($order, $type, $result, $order->delivery()->first());

            return $result;
        } catch (Throwable $th) {
            $errorId = now()->format('YmdHis') . rand(1000, 9999);
            Log::error('Error in making Payment:', [
                'type'    => $type,
                'errorId' => $errorId,
                'message' => $th->getMessage(),
            ]);
            return false;
        } finally {
            $cartItems->each->delete();
        }
    }

    protected function paymentTypeCode(string $type): int
    {
        return match ($type) {
            'online'     => 0,
            'offline'    => 1,
            'cod'        => 2,
            'wallet'     => 3,
            default      => false,
        };
    }

    protected function onlinePayment(Order $order): ?OnlinePayment
    {
        $response = $this->zarinpal->request($order);
        return OnlinePayment::create([
            'amount'  => $order->productAmountWithDelivery(),
            'user_id' => $order->user_id,
            'gateway' => 'zarinpal',
            'transaction_id' => null,
            'bank_first_response' => $response,
            'bank_second_response' => null,
            'status' => 0,
            'authority' => $response['data']['authority'],
        ]);
    }

    protected function codPayment(Order $order): ?CashPayment
    {
        return CashPayment::create([
            'amount'        => $order->order_final_amount,
            'user_id'       => $order->user_id,
            'cash_receiver' => 'Admin',
            'pay_date'      => now(),
            'status'        => 0,
        ]);
    }

    protected function offlinePayment(Order $order): ?OfflinePayment
    {
        return OfflinePayment::create([
            'amount'         => $order->order_final_amount,
            'user_id'        => $order->user_id,
            'transaction_id' => rand(1000, 9999),
            'paid_date'      => now(),
            'status'         => 0,
        ]);
    }

    protected function payment(Order $order, string $type, Model $paymentable, ?Delivery $delivery = null): ?Payment
    {
        $delivery_amount = $delivery->amount ?? 0;

        return Payment::create([
            'amount'           => $order->order_final_amount + $delivery_amount,
            'user_id'          => $order->user_id,
            'status'           => 0,
            'type'             => $this->paymentTypeCode($type),
            'paymentable_id'   => $paymentable->id,
            'paymentable_type' => $paymentable::class,
        ]);
    }

    public function registerSuccessfulOrder(Order $order, array $zarinResponse, $authority): bool
    {
        $fQuery = OnlinePayment::where('user_id', $order->user_id)->where('authority' , $authority)->update([
            'status' => 1,
            'bank_second_response' => $zarinResponse,
            'transaction_id' => $zarinResponse['data']['ref_id']
        ]);
        $sQuery = Order::whereKey($order->id)->update([
            'payment_status' => 1,
            'order_status' => 1,
        ]);
        if (!$fQuery && !$sQuery) {
            return false;
        }
        return true;
    }

    public function checkForSuccessfulOrder(Order $order, array $zarinResponse, $authority): bool
    {
        if ($order->payment_status === 0 || $order->order_status === 0) {
            OnlinePayment::where('user_id', $order->user_id)->where('authority' , $authority)->update([
                'status' => 1,
                'bank_second_response' => $zarinResponse,
                'transaction_id' => $zarinResponse['data']['ref_id']
            ]);
            $order->update([
                'payment_status' => 1,
                'order_status' => 1,
            ]);
            return true;
        }
        return true;
    }
}
