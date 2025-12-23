<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItemSelectedAttribute extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "order_item_id",
        "category_attribute_id",
        "category_value_id",
        "value"
    ];

    public function categoryAttribute()
    {
        return $this->belongsTo(CategoryAttribute::class , "category_attribute_id");
    }

    public function categoryValueAttribute()
    {
        return $this->belongsTo(CategoryValue::class , "category_value_id");
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class , "order_item_id");
    }
}
