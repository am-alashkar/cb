<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
    private function generateVerficationCode()
    {
        return Hash::make($this->getCode());
    }
    private function checkCode($code)
    {
        return Hash::check($code, $this->getCode());
    }
    private function getCode()
    {
        $pass = Auth::user()->password;
        $email = Auth::user()->email;
        return str_rot13(base64_encode($pass.$email)) ;
    }
}
