<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Provider extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $guard = 'provider';
    protected $fillable = [
        'name',
        'email',
        'password',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'profile_picture',
        'years_of_experience',
        'education',
        'certifications',
        'skills',
        'hourly_rate',
        'work_shifts',
        'work_locations',
        'availability',
        'bio',
        'background_checked',
        'languages_spoken',
    ];    
    protected $hidden = ['password', 'remember_token'];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // public function user()
    // {
    // return $this->belongsToMany(User::class);
    // } 

    public function users()
    {
    return $this->hasManyThrough(
        User::class,
        Booking::class,
        'provider_id',    // Foreign key on bookings table
        'id',             // Foreign key on users table
        'id',             // Local key on providers table
        'user_id'         // Local key on bookings table
    );
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'provider_service', 'provider_id', 'service_id')
        ->withPivot('rating') // Include extra columns from the pivot table
        ->withTimestamps(); // Include timestamps from the pivot table

    }

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    }

    public function meetings()
    {
    return $this->hasMany(Meeting::class);
    }
}
