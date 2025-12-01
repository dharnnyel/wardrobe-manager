<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public static function fromEmail(string $email): string
    {
        // get local part
        $local = strstr($email, '@', true) ?: $email;

        // remove digits
        $clean = preg_replace('/\d+/', '', $local);

        // replace common separators with space
        $clean = preg_replace('/[._\-\+]+/', ' ', $clean);

        // normalize whitespace and split
        $parts = array_values(array_filter(array_map('trim', preg_split('/\s+/', $clean))));

        if (count($parts) >= 2) {
            return ucfirst(strtolower($parts[0])) . ' ' . ucfirst(strtolower($parts[1]));
        }

        if (count($parts) === 1) {
            $token = $parts[0];

            // attempt to split camelCase or PascalCase into two words
            $split = preg_split('/(?<=[a-z])(?=[A-Z])|(?=[A-Z][a-z])/', $token);
            if (count($split) >= 2) {
                return ucfirst(strtolower($split[0])) . ' ' . ucfirst(strtolower($split[1]));
            }

            return ucfirst(strtolower($token));
        }

        return 'User';
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
                ['name' => $this->fromEmail($email), 'plan_id' => $plan->id]
            );
            Auth::login($user); //true for remember me
            return redirect()->intended($this->redirectTo);
        } else {
            return back()->withErrors(['otp' => 'Invalid One Time Password. Please try again.']);
        }
    }
}
