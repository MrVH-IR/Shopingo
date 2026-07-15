<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LockScreenController extends Controller
{
    public function lock(Request $request)
    {
        session([
            'screen_locked' => true,
            'locked_at' => now(),
        ]);

        return redirect()->route('lock-screen.show');
    }

    public function show()
    {
        abort_unless(session('screen_locked'), 403);

        return view('admin.lock-screen');
    }

    public function unlock(Request $request)
    {
        $request->validate([
            'password' => ['required']
        ]);

        if (! Hash::check($request->password, auth()->user()->password)) {

            throw ValidationException::withMessages([
                'password' => 'رمز عبور اشتباه است.'
            ]);
        }

        session()->forget('screen_locked');

        return redirect()->intended(route('admin.home'));
    }
}
