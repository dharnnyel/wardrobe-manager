<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    //
        protected $fillable = [
        'user_id',
        
        // Body Measurements
        'weight',
        'height', 
        'chest',
        'waist',
        'hips',
        'inseam',
        
        // Fit Preferences
        'top_fit',
        'bottom_fit',
        'sleeve_length',
        'pant_length',
        
        // App Preferences
        'language',
        'region',
        'theme',
        'color_scheme',
        'units',
        
        // Wardrobe Settings
        'laundry_duration',
        'laundry_reminder',
        'auto_archive',
        'archive_after',
        
        // Notification Preferences
        'push_notifications',
        'email_notifications',
        'sms_notifications',
        'laundry_reminders',
        'outfit_suggestions',
        'shopping_alerts',
        'style_tips',
        
        // Wishlist Notifications
        'wishlist_notifications',
        'wishlist_frequency',
        'price_drop_alerts',
        'restock_alerts',
        
        // Quiet Hours
        'quiet_start',
        'quiet_end',
        
        // Privacy & Security
        'public_profile',
        'share_outfits',
        'data_sharing',
        'two_factor_auth',
        'login_notifications',
    ];
}
