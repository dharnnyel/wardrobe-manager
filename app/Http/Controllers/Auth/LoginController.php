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
        //send otp to the user email
        //return redirect to verify//
        return redirect()->route('verify', ['email' => $request->input('email')]);
    }

    public function otpVerification(Request $request)
    {
        //get otp and email from user
        //match otp
        //if correct, obtain or create user
        //login user
        //return redirect to dashboard, 
        //else, return back with error invalid otp
    }
}
