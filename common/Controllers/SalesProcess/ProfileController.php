<?php

namespace Common\Controllers\SalesProcess;


use App\Models\Market\CartItem;
use Illuminate\Http\Request;
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
