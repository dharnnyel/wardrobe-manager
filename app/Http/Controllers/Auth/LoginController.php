<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    
    protected $redirectTo = '/dashboard';

    
    public function __construct()
    {
        
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request){
        //send otp to the user email
        //return redirect to verify//
        return redirect()->route('verify',['email'=> $request->email]);
    }

    public function verify(Request $request){
        dd($request->all());
        //get otp and email from user
        //match otp
        //if correct, obtain or create user
        //login user
        //return redirect to dashboard, 
        //else, return back with error invalid otp
    }
}
