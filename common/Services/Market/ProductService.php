<?php

namespace Common\Services\Market;

use App\Models\Market\Product;
use Illuminate\Support\Facades\Cache;

trait ProductService
{
    protected function incrementView(Product $product): void
    {
        $identifier = auth()->check()
            ? 'user:' . auth()->id()
            : 'guest:' . sha1(request()->ip() . request()->userAgent());

        $key = "product_view:{$product->id}:{$identifier}";

        if (Cache::add($key, true, now()->addDay())) {
            $product->increment('view');
        }
    }
}
