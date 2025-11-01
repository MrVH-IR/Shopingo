<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ["name" , "description" , "slug" , "image" , "weight" , "width",
    "height" , "price" , "status" , "marketable" , "tags" , "sold_out" , "frozen_number",
    "marketable_number" , "brand_id" , "product_categories" , "published_at"];

    public function casts(): array
    {
        return [
            "image" => "array",
            "published_at" => "date",
        ];
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories');
    }

    public function metas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
