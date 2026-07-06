<?php

namespace Common\Controllers\SalesProcess;

use Common\Models\City;
use Common\Models\Province;

class AddressController extends BaseController
{

    public function addressAndDelivery()
    {
        $provinces = Province::all();
        return view('customer.sales-process.address-and-delivery' , compact('provinces'));
    }

    public function getCities(Province  $province)
    {
        $cities = $province->cities;
        return response()->json([
            'status' => true,
            'cities' => $cities ?? ""
        ]);
    }

    public function addAddress(AddressRequest $request)
    {
        dd($request);
    }
}
