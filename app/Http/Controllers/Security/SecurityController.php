<?php

namespace App\Http\Controllers\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SecurityController extends Controller
{
    public function show(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
    {
        return view('security.verify-human');
    }

    public function verify(Request $request): RedirectResponse
    {
        $token = $request->input('cf-turnstile-response');

        if (!$token) {
            return back()->with('swal-error', 'لطفاً تایید کنید که ربات نیستید.');
        }

        $response = Http::asForm()->post(
            'https://challenges.cloudflare.com/turnstile/v0/siteverify',
            [
                'secret' => config('app.cloudflare_secret'),
                'response' => $token,
                'remoteip' => $request->ip(),
            ]
        );

        if (!$response->successful() || !$response->json('success')) {
            return back()->with('swal-error', 'تایید امنیتی ناموفق بود. لطفاً دوباره تلاش کنید.');
        }

        $request->session()->put('human_verified', true);

        return redirect()->route('customer.home');
    }
}
