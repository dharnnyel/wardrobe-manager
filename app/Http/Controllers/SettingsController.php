<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }

    public function updateProfile(Request $request) {

    }

    public function updateWardrobe(Request $request) {

    }

    public function updateBodyMeasurements(Request $request) {

    }

    public function updateAppPreferences(Request $request) {

    }

    public function updateNotifications(Request $request) {

    }

    public function updatePrivacy(Request $request) {

    }

    public function updateDataStorage(Request $request) {

    }
}
