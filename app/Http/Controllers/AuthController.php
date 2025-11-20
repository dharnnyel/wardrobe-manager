<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\OTPNotification;
use App\Utils\NameGenerator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
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
        $encryptedEmail = Crypt::encryptString($email);
        return redirect()->route('verify', ['email' => $encryptedEmail]);
    }

    public function otpVerification(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'otp' => 'required|string',
        ]);
        $email = $validated['email'];
        $otp = $validated['otp'];
        if (Otp::match($otp, $email)) {
            $plan = Plan::where('name', 'Free')->first();
            $user = User::firstOrCreate(
                ['email' => $email],
                ['name' => NameGenerator::fromEmail($email), 'plan_id' => $plan->id]
            );
            Auth::login($user); //true for remember me
            return redirect()->intended($this->redirectTo);
        } else {
            return back()->withErrors(['otp' => 'Invalid One Time Password. Please try again.']);
        }
    }
}
