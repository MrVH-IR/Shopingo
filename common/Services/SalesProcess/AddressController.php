<?php

namespace Common\Services\SalesProcess;

use App\Models\Market\Delivery;
use Common\Services\SalesProcess\Request\AddressRequest;
use Common\Models\Address;
use Common\Models\Province;
use Illuminate\Support\Facades\Cache;

class AddressController extends BaseController
{

    public function addressAndDelivery()
    {
        $provinces = Cache::remember('province' , now()->addHours(2) , function () {
            return Province::all();
        });
        $deliveries = Cache::remember('deliveries' , now()->addHours(2) , function () {
            return Delivery::all();
        });
        return view('customer.sales-process.address-and-delivery' , compact('provinces', 'deliveries'));
    }

    public function getCities(Province  $province)
    {
        $cities = $province->cities;
        return response()->json([
            'status' => true,
            'cities' => $cities ?? ""
        ]);
    }

    public function getAddress(Address $address)
    {
        abort_if($address->user_id != auth()->id(), 403);

        return response()->json($address);
    }

    public function addAddress(AddressRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Address::create($validated);
        return redirect()->back()->with([
            'bootstrap-success' => [
                'status' => 'موفق',
                'message' => 'آدرس شما با موفقیت ثبت شد.'
            ]
        ]);
    }

    public function updateAddress(AddressRequest $request)
    {
        $validated = $request->validated();

        $address = auth()->user()->addresses()
            ->where('id', $validated['id'])
            ->firstOrFail();

        $address->update($validated);

        return redirect()->back()->with([
            'bootstrap-success' => [
                'status' => 'موفق',
                'message' => 'آدرس شما با موفقیت ویرایش شد.'
            ]
        ]);
    }
}
