<?php

namespace Common\Services\Profile;

use Common\Models\Address;
use Common\Models\Province;
use Common\Services\Response\Responses;
use Illuminate\Http\RedirectResponse;

class AddressController extends BaseController
{

    public function index()
    {
        $provinces = Province::all();
        return view('customer.profile.addresses', compact('provinces'));
    }

    public function deleteAddress(Address $address): RedirectResponse
    {
        abort_if($address->user_id !== auth()->id(), 403);
        $address->delete();
        return Responses::redirectToWithBack('success','موفق','آدرس شما با موفقیت حذف شد');
    }
}
