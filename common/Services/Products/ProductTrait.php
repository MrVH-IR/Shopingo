<?php

namespace Common\Services\Products;

trait ProductTrait
{

    protected function sortOrder(int $number): array
    {
        return match ($number) {
            1 => ['created_at', 'DESC'],
            2 => ['price', 'DESC'],
            3 => ['price', 'ASC'],
            4 => ['view', 'DESC'],
            5 => ['sold_out', 'DESC'],
            default => ['created_at', 'DESC'],
        };
    }
}
