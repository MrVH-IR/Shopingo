<?php

namespace Common\Services\SalesProcess;

use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\Order;
use Common\Services\Payment\Requests\ChooseAddressAndDeliveryRequest;
use Common\Services\Response\Responses;
use Common\Services\SalesProcess\Request\AddressRequest;
use Common\Models\Address;
use Common\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AddressController extends BaseController
{

    public function __construct(
        protected OrderService $orderService
    ) {}

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
        return Responses::redirectToWithBack('success', 'موفق', 'آدرس شما با موفقیت ثبت شد.');
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

    /**
     * @throws \Exception
     */
    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request): RedirectResponse
    {
        $user = auth()->id();
        $data = $this->orderService->createPendingOrder($user , $request->address , $request->delivery_type);
        if ($data['status'] !== true) {
            return redirect()->back()->with([
                'bootstrap-error' => [
                    'status' => 'خطا',
                    'message' => 'مشکلی در ثبت سفارش پیش آمده است. لطفا با مدیریت تماس حاصل فرمایید'
                ]
            ]);
        }

        return redirect()->route('customer.sales-process.payment');
    }
}
