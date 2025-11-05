<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'photo',
        'bio',

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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
