<?php

namespace App\Models\Market;

use App\Models\User;
use Common\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "address_id",
        "address_object",
        "payment_id",
        "payment_object",
        "payment_type",
        "payment_status",
        "delivery_id",
        "delivery_object",
        "delivery_amount",
        "delivery_status",
        "delivery_date",
        "order_final_amount",
        "order_discount_amount",
        "coupon_id",
        "coupon_object",
        "order_coupon_discount_amount",
        "common_discount_id",
        "common_discount_object",
        "order_common_discount_amount",
        "order_total_products_discounts_amount",
        "order_status"
    ];

    protected function casts(): array
    {
        return [
            "delivery_date" => "datetime"
        ];
    }

    public function getPaymentStatusValueAttribute(): string
    {
        return match ($this->payment_status) {
            0 => "پرداخت نشده",
            1 => "پرداخت شده",
            2 => "باطل شده",
            3 => "برگشت داده شده",
            default => "نامعلوم"
        };
    }

    public function getPaymentTypeValueAttribute(): string
    {
        return match ($this->payment_type) {
            0 => "آنلاین",
            1 => "آفلاین",
            default => "در محل"
        };
    }

    public function getDeliveryStatusValueAttribute(): string
    {
        return match ($this->delivery_status) {
            0 => "ارسال نشده",
            1 => "درحال ارسال",
            2 => "ارسال شده",
            3 => "تحویل شده",
            default => "نامعلوم"
        };
    }

    public function getOrderStatusValueAttribute(): string
    {
        return match ($this->order_status) {
            0 => "بررسی نشده",
            1 => "در انتظار تایید",
            2 => "تایید نشده",
            3 => "تایید شده",
            4 => "باطل شده",
            5 => "مرجوع شده",
            default => "نامعلوم"
        };
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount()
    {
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeCouponlessOrders($query)
    {
        return $query->where('order_status' , 0)
                     ->whereNull('coupon_id');
    }

    public function productAmountWithDelivery()
    {
        return $this->order_final_amount + $this->delivery->amount;
    }
}
