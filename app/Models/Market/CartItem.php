<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'product_id',
        'color_id',
        'guarantee_id',
        'numbers',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function guarantee(): BelongsTo
    {
        return $this->belongsTo(Guarantee::class);
    }

    public function cartItemProductPrice()
    {
        return
            $this->product->price +
            ($this->color?->price_increase ?? 0) +
            ($this->guarantee?->price_increase ?? 0);
    }

    public function cartItemProductDiscount()
    {
        return $this->cartItemProductPrice()
            * (($this->product->activeAmazingSales()?->percentage ?? 0) / 100);
    }

    public function cartItemFinalPrice()
    {
        return (
                $this->cartItemProductPrice() -
                $this->cartItemProductDiscount()
            ) * $this->numbers;
    }

    public function cartItemFinalDiscount()
    {
        return $this->cartItemProductDiscount() * $this->numbers;
    }
}
