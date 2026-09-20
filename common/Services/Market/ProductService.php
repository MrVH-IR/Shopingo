<?php

namespace Common\Services\Market;

use App\Models\Content\Comment;
use App\Models\Market\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

trait ProductService
{
    protected static function incrementView(Product $product): void
    {
        $identifier = auth()->check()
            ? 'user:' . auth()->id()
            : 'guest:' . sha1(request()->ip() . request()->userAgent());

        $key = "product_view:{$product->id}:{$identifier}";

        if (Cache::add($key, true, now()->addDay())) {
            $product->increment('view');
        }
    }

    protected static function createComment(string $body , int $author, string $model, int $model_id): bool
    {
        Comment::create([
            'body' => $body,
            'author_id' => $author,
            'commentable_type' => $model,
            'commentable_id' => $model_id,
            'approved' => 0,
            'status' => 0,
            'seen' => 0
        ]);

        return true;
    }

    protected static function createFavorite(Product $product, $user): bool
    {
        $product->user()->toggle($user->id);

        return $isFavorite = $product
            ->user()
            ->whereKey($user->id)
            ->exists();
    }
}
