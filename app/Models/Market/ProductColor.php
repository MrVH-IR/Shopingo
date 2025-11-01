<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    protected $fillable = ["color_name", "product_id" , "price_increase" , "sold_out" , "frozen_number" , "marketable_number" , "status"];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
