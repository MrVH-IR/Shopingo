<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use SoftDeletes , HasFactory;
    protected $fillable = [
        "name",
        "description",
        "slug",
        "image",
        "status",
        "show_in_menu",
        "tags",
        "parent_id",
    ];

    public function casts()
    {
        return [
          "image" => "array"
        ];
    }

    public function parent()
    {
        return $this->belongsTo(ProductCategory::class, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany(ProductCategory::class, 'parent_id')->with('children');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'product_categories');
    }

    public function attributes()
    {
        return $this->hasMany(CategoryAttribute::class);
    }
}
