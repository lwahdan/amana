<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description', 
        'price', 
        'status',
        'image',
    ];

    public function bookings()
    {
    return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
    return $this->hasMany(Review::class);
    } 

    public function category()
    {
    return $this->belongsTo(Category::class);
    } 

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'provider_service', 'service_id', 'provider_id')
        ->withPivot('rating')
        ->withTimestamps();
    } 

    public function meetings()
    {
    return $this->hasMany(Meeting::class);
    }

    public function blogs(){
        return $this->hasMany(Blog::class);
    }

}
