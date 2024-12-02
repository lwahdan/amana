<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone', 
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }
    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function contactMessages()
    {
    return $this->hasMany(ContactMessage::class);
    }

    public function meetings()
    {
    return $this->hasMany(Meeting::class);
    }

    public function providers()
{
    return $this->hasManyThrough(
        Provider::class,  // Final target model
        Booking::class,   // Intermediate model
        'user_id',        // Foreign key on bookings table
        'id',             // Foreign key on providers table
        'id',             // Local key on users table
        'provider_id'     // Local key on bookings table
    );
}
}
