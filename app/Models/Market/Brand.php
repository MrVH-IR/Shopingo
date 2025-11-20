<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use SoftDeletes , HasFactory;

    protected $fillable = [
        "persian_name",
        "original_name",
        "slug",
        "image",
        "status",
        "tags",
    ];

    public function casts()
    {
        return [
            "image" => "array"
        ];
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
