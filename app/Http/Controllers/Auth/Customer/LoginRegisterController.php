<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\OtpService\OtpService;
use App\Models\User;

class LoginRegisterController extends Controller
{
    public function loginRegisterForm()
    {
        return view('customer.auth.login-register');
    }

    public function loginRegister(LoginRegisterRequest $request , OtpService $otpService)
    {
        $validated = $request->validated();

        // check if email or number
        if (filter_var($validated['identify'], FILTER_VALIDATE_EMAIL))
        {
            $type = 1; // Type 1 Is Email
            $user = User::where('email', $validated['identify'])->first();
            if (empty($user)) {
                $newUser['email'] = $validated['identify'];
            }
        } elseif (preg_match('/^09\d{9}$/' , $validated['identify'])) {
            $type = 0; // Type 0 Is Mobile

            // All Mobile Numbers Must Have format - start with 9** *** ***
            $validated['identify'] = ltrim($validated['identify'], '0');
            $validated['identify'] = substr($validated['identify'] , 0 , 2) === '98'
                    ? substr($validated['identify'] , 2 )
                    : $validated['identify'];
            $validated['identify'] = str_replace('+98' , '' , $validated['identify']);
            $user = User::where('mobile' , $validated['identify'])->first();
            if (empty($user)) {
                $newUser['mobile'] = $validated['identify'];
            }
        } else {
            $errorText = "شناسه ورودی شما نه شماره موباید است نه ایمیل";
            return redirect()->route('auth.customer.login-register-form')
                ->withErrors(["identify" => $errorText]);
        }

        if (empty($user)) {
            $newUser['password'] = bcrypt($validated['identify']) . bcrypt('ShopingoIsTheBest');
            $newUser['activation'] = 1;
            $newUser['activation_date'] = now();
            $newUser['email'] = $validated['identify'] . '@shopingois.com';
            $user = User::create($newUser);
        }
        // Create OTP Code & Send
        $otpService->generateAndSave(
            $validated['identify'],
            $user->id,
            $type
        );

        return redirect()->route('auth.customer.login-register-form');
    }
}
