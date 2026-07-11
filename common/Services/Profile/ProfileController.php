<?php

namespace Common\Services\Profile;

use Common\Services\Profile\Requests\ProfileUpdateRequest;
use Common\Services\Response\Responses;
use Illuminate\Http\RedirectResponse;

class ProfileController extends BaseController
{

    public function index()
    {
        return view('customer.profile.profile');
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        auth()->user()->update([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'national_code' => $validated['national_code'],
        ]);

        return Responses::redirectToWith('customer.profile.profile', 'success', 'موفق', 'پروفایل کاربری شما با موفقیت ویرایش شد');
    }
}
