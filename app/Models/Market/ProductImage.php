<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductImage extends Model
{
    use SoftDeletes;

    protected $fillable = ["image" , "product_id"];

    protected function casts()
    {
        return [
            "image" => "array"
        ];
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
