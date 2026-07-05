<?php

namespace Common\Controllers\SalesProcess;

class AddressController extends BaseController
{

    public function addressAndDelivery()
    {
        return view('customer.sales-process.address-and-delivery');
    }

    public function addAddress() {}
}
