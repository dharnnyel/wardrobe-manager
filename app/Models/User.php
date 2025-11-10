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
        'plan_id',
        'email',
        'plan_id',
    ];

    protected $casts = [
        'password' => 'hashed',
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
