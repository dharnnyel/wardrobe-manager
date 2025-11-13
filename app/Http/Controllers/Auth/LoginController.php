<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        return redirect()->route('verify', ['email' => $request->input('email')]);
    }

    public function otpVerification(Request $request)
    {
        // OTP verification logic goes here
    }
}
