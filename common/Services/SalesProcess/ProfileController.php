<?php

namespace Common\Services\SalesProcess;


use App\Models\Market\CartItem;
use Common\Services\SalesProcess\Request\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends BaseController
{

    public function profile()
    {
        $cartItems = CartItem::query()->where('user_id', auth()->id())->get();
        return view('customer.sales-process.profile-completion', compact('cartItems'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->all());
        return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
