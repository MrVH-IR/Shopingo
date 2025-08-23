<?php

namespace App\Repository;

use App\Models\Content\PostCategory as Model;

class PostCategory
{

    CONST CACHE_KEY = 'post_categories';

    public function all($orderBy, $direction = null)
    {
        $key = "all.{$orderBy}";
        $cacheKey = $this->getCacheKey($key);
        if ($direction === null) {
            return cache()->remember($cacheKey, now()->addMinutes(5), function () use ($key, $orderBy) {
                return Model::orderBy($orderBy)->get();
            });
        } else {
            return cache()->remember($cacheKey, now()->addMinutes(5), function () use ($key, $orderBy, $direction) {
               return Model::orderBy($orderBy, $direction)->get();
            });
        }
    }

    public function getCacheKey($key)
    {
        return self::CACHE_KEY . "." . $key;
    }
}
