<?php

namespace Common\Services\Payment\Contracts;

use App\Models\Market\Order;

interface PaymentGateway
{
    public function request(Order $order): array;

    public function verify(Order $order, string $authority): array;
}
