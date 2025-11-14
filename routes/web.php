<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::view('/', 'index');
Route::view('features', 'features');
Route::view('pricing', 'pricing');
Route::view('help', 'help');
Route::view('blog', 'blog');

// Auth Group
Route::middleware('guest')->group(function () {
  Route::get('login', function () {
    return view('auth.login');
  })->name('login');

  Route::post('login', [LoginController::class, 'login'])->name('login');

  Route::get('verify/{email}', function ($email) {
    return view('auth.verify')->with(['email'=> $email]);
  })->name('verify');

  Route::post('verification', [LoginController::class, 'otpVerification'])->name('verification');
});

Route::middleware('auth')->group(function () {
  Route::post('logout', function () {
    Auth::logout();
    return redirect()->to('/');
  })->name('logout');
  Route::view('dashboard', 'dashboard.home');
  Route::view('dashboard/wardrobe', 'dashboard.wardrobe');
  Route::view('dashboard/interests', 'dashboard.interests');
  Route::view('dashboard/wishlist', 'dashboard.wishlist');
  Route::view('dashboard/shopping', 'dashboard.shopping');
  Route::view('dashboard/orders', 'dashboard.orders');
  Route::view('dashboard/settings', 'dashboard.settings');
// Route::view('dashboard/notifications', 'dashboard.notifications');
});
