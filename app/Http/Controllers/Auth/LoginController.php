<?php

namespace App\Http\Controllers\Auth;

use App\Models\Plan;
use App\Models\User;
use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\Notification;

class LoginController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);
        $email = $validated['email'];
        $otp = Otp::generate($email);
        Notification::route('mail', $email)->notify(new OTPNotification($otp));
        return redirect()->route('verify', ['email' => $email]);
    }

    public function otpVerification(Request $request)
    {
        
        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);
        $email = $validated['email'];
        $otp = $validated['otp'];
        if ($valid = Otp::match($otp, $email)) {
            $plan = Plan::where('name', 'Free')->first();
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => explode('@', $email)[0],'plan_id'=> $plan->id] 
            );
            Auth::login($user); //true for remember me
            return redirect()->intended($this->redirectTo);
        } else {
            return back()->withErrors(['otp' => 'Invalid One Time Password. Please try again.']);
        }
    }
}
