<?php

namespace Common\Services\SalesProcess;

use App\Models\Market\Product;
use LogicException;

class StockService
{
    /**
     * The product must already be locked with lockForUpdate()
     * inside an active database transaction.
     */
    public function adjustReservation(Product $product, int $delta): bool
    {
        $currentReserved = (int) $product->frozen_number;
        $newReserved = $currentReserved + $delta;

        // Prevent invalid reservation counts.
        if ($newReserved < 0) {
            throw new LogicException(
                "Reserved stock cannot be negative for product {$product->id}", 403
            );
        }

        // Check available stock before increasing reservation.
        if ($delta > 0 && $newReserved > (int) $product->marketable_number) {
            return false;
        }

        $product->frozen_number = $newReserved;
        $product->save();

        return true;
    }
}
