<?php

namespace Common\Services\Profile;

use Common\Models\Province;

class AddressController extends BaseController
{

    public function index()
    {
        $provinces = Province::all();
        return view('customer.profile.addresses', compact('provinces'));
    }
}
