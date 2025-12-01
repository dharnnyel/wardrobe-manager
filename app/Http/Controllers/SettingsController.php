<?php

namespace App\Http\Controllers;

use Tzsk\Otp\Facades\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\OTPNotification;
use Illuminate\Support\Facades\Notification;

class SettingsController extends Controller
{
    public function index()
    {
        return view('dashboard.settings');
    }

    // Send OTP for new email
    private function sendOtpForEmailChange($newEmail)
    {
        $otp = Otp::generate($newEmail);

        try {
            Notification::route('mail', $newEmail)
                ->notify(new OTPNotification($otp));

            return response()->json([
                'message' => "Verification code sent to $newEmail",
                'otp_sent' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => ['email' => ['Failed to send verification code. Please try again.']]
            ], 422);
        }
    }

    // Verify OTP for email change
    private function verifyEmailWithOtp($user, $newEmail, $otp)
    {
        if (!Otp::match($otp, $newEmail)) {
            return response()->json([
                'errors' => [
                    'otp_code' => ["Invalid verification code."]
                ]
            ], 422);
        }
        $user->email = $newEmail;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Email updated successfully.'
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = $request->user();

        if ($request->has('style_tags') && is_string($request->input('style_tags'))) {
            $decoded = json_decode($request->input('style_tags'), true);
            $request->merge(['style_tags' => is_array($decoded) ? $decoded : []]);
        }

        $validated = $request->validate([
            'name' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
            'bio' => 'sometimes|nullable|string|max:1000',
            'style_tags' => 'sometimes|nullable|array',
            'style_tags.*' => 'nullable|string|max:50',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $user->id,
            'otp_code' => 'sometimes|string|size:6',
        ]);

        if (isset($validated['email']) && $validated['email'] !== $user->email) {
            $newEmail = $validated['email'];

            if ($request->filled('otp_code')) {
                return $this->verifyEmailWithOtp($user, $newEmail, $request->otp_code);
            }

            return $this->sendOtpForEmailChange($newEmail);
        }

        if ($request->has('style_tags')) {
            $styleTags = $request->input('style_tags', []);

            $filteredTags = array_filter($styleTags, function ($tag) {
                return $tag !== null && $tag !== '' && is_string($tag) && trim($tag) !== '';
            });

            $user->style_tags = array_values($filteredTags);
        }

        foreach (['name', 'phone', 'bio'] as $field) {
            if (isset($validated[$field])) {
                $user->$field = $validated[$field];
            }
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully.'
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Profile updated successfully.');
    }

    public function updateWardrobe(Request $request)
    {
        $user = $request->user();

        if ($request->has('clothing_categories') && is_string($request->input('clothing_categories'))) {
            $decoded = json_decode($request->input('clothing_categories'), true);
            $request->merge(['clothing_categories' => is_array($decoded) ? $decoded : []]);
        }

        $validated = $request->validate([
            'laundry_duration' => 'sometimes|nullable|integer|min:1|max:5',
            'laundry_reminder' => 'sometimes|nullable|integer|min:0|max:3',
            'auto_archive' => 'sometimes|nullable|boolean',
            'archive_after' => 'sometimes|nullable|integer|min:1|max:24',
            'clothing_categories' => 'sometimes|nullable|array',
            'clothing_categories.*' => 'nullable|string|max:50',
        ]);

        // Handle auto_archive checkbox - if not checked, set to false
        if (!isset($validated['auto_archive'])) {
            $validated['auto_archive'] = false;
        }

        // Handle auto_archive and archive_after relationship
        if (!$validated['auto_archive']) {
            $validated['archive_after'] = null;
        }

        if ($request->has('clothing_categories')) {
            $categoryTags = $request->input('clothing_categories', []);

            Log::debug('Processing raw style tags:', $categoryTags);

            // More robust filtering that handles NULL and empty values
            $filteredTags = array_filter($categoryTags, function ($tag) {
                return $tag !== null && $tag !== '' && is_string($tag) && trim($tag) !== '';
            });

            Log::debug('Filtered style tags:', $filteredTags);

            $user->clothing_categories = array_values($filteredTags);
            Log::debug('Setting user clothing_categories to:', $user->clothing_categories);
        } else {
            Log::debug('No clothing_categories in request');
        }

        // Update all fields from the validated array
        foreach (['laundry_duration', 'laundry_reminder', 'auto_archive', 'archive_after'] as $field) {
            if (isset($validated[$field])) {
                $user->$field = $validated[$field];
            }
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Wardrobe updated successfully.'
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Wardrobe settings updated successfully.');
    }


    public function updateBodyMeasurements(Request $request)
    {
        $user = $request->user();
        $validated = $request->validate([
            'weight' => 'sometimes|nullable|numeric|min:30|max:300',
            'height' => 'sometimes|nullable|numeric|min:100|max:250',
            'chest' => 'sometimes|nullable|numeric|min:50|max:200',
            'waist' => 'sometimes|nullable|numeric|min:40|max:150',
            'hips' => 'sometimes|nullable|numeric|min:50|max:200',
            'inseam' => 'sometimes|nullable|numeric|min:50|max:120',
            'top_fit' => 'sometimes|nullable|string|in:slim,regular,relaxed,oversized',
            'bottom_fit' => 'sometimes|nullable|string|in:skinny,slim,regular,relaxed',
            'sleeve_length' => 'sometimes|nullable|string|in:short,long,any',
            'pant_length' => 'sometimes|nullable|string|in:ankle,regular,long,any',
            'body_shape' => 'sometimes|nullable|string|in:apple,pear,hourglass,rectangle',
        ]);
        foreach (
            [
                'weight',
                'height',
                'chest',
                'waist',
                'hips',
                'inseam',
                'top_fit',
                'bottom_fit',
                'sleeve_length',
                'pant_length',
                'body_shape'
            ] as $field
        ) {
            if (isset($validated[$field])) {
                $user->$field = $validated[$field];
            }
        }
        $user->save();
        return redirect()->route('settings.index')
            ->with('success', 'Body measurements updated successfully.');
    }

    public function updateAppPreferences(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'theme' => 'sometimes|nullable|string|in:light,dark,auto',
            'high_contrast' => 'sometimes|nullable|boolean',
            'color_scheme' => 'sometimes|nullable|string|in:primary,secondary,accent,success,yellow-500,pink-500',
            'language' => 'sometimes|nullable|string|max:10',
            'region' => 'sometimes|nullable|string|max:10',
            'temperature_unit' => 'sometimes|nullable|string|in:celsius,fahrenheit',
            'measurement_unit' => 'sometimes|nullable|string|in:metric,imperial',
        ]);

        // Handle high_contrast checkbox
        if (!isset($validated['high_contrast'])) {
            $validated['high_contrast'] = false;
        }

        // Update user fields
        foreach ($validated as $field => $value) {
            $user->$field = $value;
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'App preferences updated successfully.',
                'theme' => $user->theme,
                'color_scheme' => $user->color_scheme,
                'high_contrast' => $user->high_contrast
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'App preferences updated successfully.');
    }

    public function updateNotifications(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'push_notifications' => 'sometimes|nullable|boolean',
            'notification_sound' => 'sometimes|nullable|boolean',
            'notification_vibration' => 'sometimes|nullable|boolean',
            'marketing_emails' => 'sometimes|nullable|boolean',
            'weekly_digest' => 'sometimes|nullable|boolean',
            'laundry_reminders' => 'sometimes|nullable|boolean',
            'item_suggestions' => 'sometimes|nullable|boolean',
            'outfit_recommendations' => 'sometimes|nullable|boolean',
            'style_tips' => 'sometimes|nullable|boolean',
            'quiet_hours' => 'sometimes|nullable|boolean',
            'quiet_start' => 'sometimes|nullable|date_format:H:i',
            'quiet_end' => 'sometimes|nullable|date_format:H:i',
        ]);

        $booleanFields = [
            'push_notifications' => false,
            'notification_sound' => false,
            'notification_vibration' => false,
            'marketing_emails' => false,
            'weekly_digest' => false,
            'laundry_reminders' => false,
            'item_suggestions' => false,
            'outfit_recommendations' => false,
            'style_tips' => false,
            'quiet_hours' => false,
        ];

        foreach ($booleanFields as $field => $defaultValue) {
            if ($field === 'quiet_hours') {
                $user->$field = $validated['quiet_hours'] ?? $defaultValue;
            } else {
                $user->$field = $validated[$field] ?? $defaultValue;
            }
        }

        if ($user->quiet_hours) {
            if (empty($validated['quiet_start']) || empty($validated['quiet_end'])) {
                $errors = [
                    'quiet_hours' => ['Both quiet start and end times must be provided when quiet hours are enabled.']
                ];

                if ($request->expectsJson()) {
                    return response()->json(['errors' => $errors], 422);
                }

                return redirect()->back()->withErrors($errors)->withInput();
            };

            $user->quiet_start = $validated['quiet_start'];
            $user->quiet_end = $validated['quiet_end'];
        } else {
            $validated['quiet_start'] = null;
            $validated['quiet_end'] = null;
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Notification preferences updated successfully.'
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Notification preferences updated successfully.');
    }

    public function updatePrivacy(Request $request) {
        $user = $request->user();

        $validated = $request->validate([
            'login_notifications' => 'sometimes|nullable|boolean',
            'profile_visibility' => 'sometimes|nullable|string|in:public,friends_only,private',
            'data_sharing' => 'sometimes|nullable|boolean',
            'personalized_ads' => 'sometimes|nullable|boolean',
            'camera_access' => 'sometimes|nullable|boolean',
            'location_access' => 'sometimes|nullable|boolean',
            'photo_library_access' => 'sometimes|nullable|boolean',
        ]);

        $booleanFields = [
            'login_notifications' => false,
            'data_sharing' => false,
            'personalized_ads' => false,
            'camera_access' => false,
            'location_access' => false,
            'photo_library_access' => false,
            'cloud_storage' => false,
            'local_backup' => false,
        ];

        foreach ($booleanFields as $field => $defaultValue) {
            $user->$field = $validated[$field] ?? $defaultValue;
        }

        if (isset($validated['profile_visibility'])) {
            $user->profile_visibility = $validated['profile_visibility'];
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Privacy & Security settings updated successfully.'
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Privacy & security settings updated successfully.');
    }

    public function updateDataStorage(Request $request) {
        $user = $request->user();

        $validated = $request->validate([
            'cloud_storage' => 'sometimes|nullable|boolean',
            'local_backup' => 'sometimes|nullable|boolean',
        ]);

        $booleanFields = [
            'cloud_storage' => false,
            'local_backup' => false,
        ];

        foreach ($booleanFields as $field => $defaultValue) {
            $user->$field = $validated[$field] ?? $defaultValue;
        }

        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data storage settings updated successfully.'
            ]);
        }

        return redirect()->route('settings.index')
            ->with('success', 'Data storage settings updated successfully.');
    }
}
