<?php

namespace Common\Services\Payment;

class PaymentController extends BaseController
{
    public function payment()
    {
        return view('customer.payment.index');
    }
}
