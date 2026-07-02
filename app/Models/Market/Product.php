<?php

namespace App\Models\Market;

use App\Models\Content\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes , HasFactory;

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

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_categories');
    }

    public function metas(): HasMany
    {
        return $this->hasMany(ProductMeta::class);
    }

    public function colors(): Product|HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function images(): Product|HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function values(): Product|HasMany
    {
        return $this->hasMany(CategoryValue::class);
    }

    public function guarantees(): Product|HasMany
    {
        return $this->hasMany(Guarantee::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function amazingSales(): Product|HasMany
    {
        return $this->hasMany(AmazingSale::class);
    }

    public function activeAmazingSales(): object|null
    {
        return $this->amazingSales()->where('start_at', '<' , now())
            ->where('end_at', '>' , now())
            ->where('status' , '1')
            ->first();
    }

    public function getActiveComment(): object|null
    {
        return $this->comments()
            ->where('approved' , 1)
            ->where('status' , 1)
            ->whereNull('parent_id')
            ->get();
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
