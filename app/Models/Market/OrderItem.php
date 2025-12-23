<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = ["order_id" , "product_id" , "product" , "amazing_sale_id",
        "amazing_sale_object" , "amazing_discount_amount" , "number" , "final_product_price",
        "final_total_price" , "guarantee_id" , "color_id"];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function singleProduct()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function amazingSale()
    {
        return $this->belongsTo(AmazingSale::class , 'amazing_sale_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class , 'color_id');
    }

    public function guarantee()
    {
        return $this->belongsTo(Guarantee::class , 'guarantee_id');
    }

    public function orderItemAttributes()
    {
        return $this->hasMany(OrderItemSelectedAttribute::class);
    }
}
