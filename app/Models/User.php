<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Payment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'plan_id',
        'email',
    ];

    protected $casts = [
        'style_tags' => 'array',
        'clothing_categories' => 'array',
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

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function subscription(){
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    public function subscriptions(){
        return $this->hasMany(Subscription::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function defaultPaymentMethod(){
        return $this->hasOne(PaymentMethod::class)->where('is_default', true);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

    public function clothings(){
        return $this->hasMany(Clothing::class);
    }
    public function laundries(){
        return $this->hasMany(Laundry::class);
    }
    public function outfits(){
        return $this->hasMany(Outfit::class);
    }
    public function interests(){
        return $this->hasMany(Interest::class);
    }



}
