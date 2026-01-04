<?php

namespace App\Repository;

use App\Models\User as Model;


class User {

    const CACHE_KEY = "user";

    public function all($orderBy = "id", $direction = "desc")
    {
        $key = "all.{$orderBy}{$direction}";
        $cacheKey = $this->getCacheKey($key);
        return cache()->remember($cacheKey, now()->addMinutes(5), function () use ($key, $orderBy, $direction) {
            return Model::orderBy($orderBy, $direction)->get();
        });
    }

    public function getCacheKey($key)
    {
        return self::CACHE_KEY . "." . $key;
    }
}
