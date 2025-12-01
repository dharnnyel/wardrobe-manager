<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DataManagementController;

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

  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::get('verify/{email}', function ($encryptedEmail) {
    $email = Crypt::decryptString($encryptedEmail);
    return view('auth.verify')->with(['email' => $email]);
  })->name('verify');

  Route::post('verification', [AuthController::class, 'otpVerification'])->name('verification');
});

Route::middleware('auth')->group(function () {
  Route::post('logout', function () {
    Auth::logout();
    return redirect()->to('/');
  })->name('logout');
  Route::view('dashboard', 'dashboard.home');
  Route::view('wardrobe', 'dashboard.wardrobe');
  Route::view('interests', 'dashboard.interests');
  Route::view('wishlist', 'dashboard.wishlist');
  Route::view('shopping', 'dashboard.shopping');
  Route::view('orders', 'dashboard.orders');

  Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');

    Route::prefix('profile')->name('profile.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateProfile'])->name('update');
    });

    Route::prefix('wardrobe')->name('wardrobe.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateWardrobe'])->name('update');
    });

    Route::prefix('body')->name('body.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateBodyMeasurements'])->name('update');
    });

    Route::prefix('app-preferences')->name('app-preferences.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateAppPreferences'])->name('update');
    });

    Route::prefix('notifications')->name('notifications.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateNotifications'])->name('update');
    });

    // TODO: Subscription and Billing
    Route::prefix('subscription')->name('subscription.')->group(function () {
      Route::patch('/update', [SubscriptionController::class, 'update'])->name('update');
      Route::patch('/update-reminder', [SubscriptionController::class, 'updateReminder'])->name('update-reminder');
      Route::post('/change-plan', [SubscriptionController::class, 'changePlan'])->name('change-plan');
      Route::post('/cancel', [SubscriptionController::class, 'cancel'])->name('cancel');
      Route::post('/resume', [SubscriptionController::class, 'resume'])->name('resume');
    });

    Route::prefix('privacy')->name('privacy.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updatePrivacy'])->name('update');
    });

    Route::prefix('export')->name('export.')->group(function () {
      Route::post('/wardrobe', [ExportController::class, 'exportWardrobe'])->name('wardrobe');
      Route::post('/preferences', [ExportController::class, 'exportPreferences'])->name('preferences');
      Route::post('/account', [ExportController::class, 'exportAccount'])->name('account');
    });

    Route::prefix('delete')->name('delete.')->group(function () {
      Route::delete('/wardrobe', [DataManagementController::class, 'deleteWardrobe'])->name('wardrobe');
      Route::delete('/preferences', [DataManagementController::class, 'deletePreferences'])->name('preferences');
      Route::delete('/account', [DataManagementController::class, 'deleteAccount'])->name('account');
    });

    // Data Storage Settings
    Route::prefix('data-storage')->name('data-storage.')->group(function () {
      Route::patch('/update', [SettingsController::class, 'updateDataStorage'])->name('update');
    });
  });

  Route::prefix('billing')->name('billing.')->group(function () {
    Route::get('/portal', [SubscriptionController::class, 'billingPortal'])->name('portal');
    Route::post('/payment-method', [SubscriptionController::class, 'updatePaymentMethod'])->name('payment-method.update');
    Route::get('/invoices', [SubscriptionController::class, 'invoices'])->name('invoices');
    Route::get('/invoice/{invoice}', [SubscriptionController::class, 'downloadInvoice'])->name('invoice.download');
  });

  Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('callback', [SubscriptionController::class, 'callback'])->name('callback');
  });

});
