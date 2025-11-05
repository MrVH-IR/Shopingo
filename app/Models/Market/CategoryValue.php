<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryValue extends Model
{
    use SoftDeletes;

    protected $fillable = ["product_id", "category_attribute_id", "value" , "type"];

    public function attribute()
    {
        return $this->belongsTo(CategoryAttribute::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
