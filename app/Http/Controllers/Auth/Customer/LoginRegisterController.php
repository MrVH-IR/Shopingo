<?php

namespace App\Http\Controllers\Auth\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Customer\LoginConfirmRequest;
use App\Http\Requests\Auth\Customer\LoginRegisterRequest;
use App\Http\Services\OtpService\OtpService;
use App\Models\User;
use Carbon\Carbon;
use Common\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            if ($type == 0) {
                $newUser['email'] = $validated['identify'] . '@shopingo.com';
                $newUser['mobile'] = $validated['identify'];
            } elseif ($type == 1) {
                $newUser['email'] = $validated['identify'];
            }
            $user = User::create($newUser);
        }
        $token = Str::random(64);
        // Create OTP Code & Send
        $otpService->generateAndSave(
            $validated['identify'],
            $user->id,
            $type,
            $token
        );

        return redirect()->route('auth.customer.login-confirm-form' , $token);
    }

    public function loginConfirmForm($token)
    {
        $otp = Otp::where('token' , $token)->first();
        if (empty($otp))
        {
            return redirect()->route('auth.customer.login-register-form')
                ->withErrors(['id' => 'آدرس وارد شده نامعتبر می باشد']);
        }
        return view('customer.auth.login-confirm' , compact('token'));
    }

    public function loginConfirm($token , LoginConfirmRequest $request)
    {
        $validated = $request->validated();

        $otp = Otp::where('token' , $token)->where('used' , 0)->where('created_at' , '>=' , Carbon::now()->subMinute(5)->toDateTimeString())->first();
        if (empty($otp)) {
            return redirect()->route('auth.customer.login-register-form', ['token' => $token])
                ->withErrors(['id' => 'نامعتبر']);
        }

        // If OTP not MATCH
        if ($otp->otp_code !== $validated['code']) {
            return redirect()->route('auth.customer.login-confirm-form', ['token' => $token])
                ->withErrors(['otp' => 'کد وارد شده صحیح نمی باشد']);
        }

        // If Everything OK
        $otp->update(['used' => 1]);
        $user = $otp->user()->first();
        if ($otp->type == 0 && empty($user->mobile_verified_at)) {
            $user->update(['mobile_verified_at' => now()]);
        } elseif ($otp->type == 1 && empty($user->email_verified_at)) {
            $user->update(['email_verified_at' => now()]);
        }
        Auth::loginUsingId($user->id);
        return redirect()->route('customer.home');
    }
}
