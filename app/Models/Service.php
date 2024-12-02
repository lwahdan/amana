<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description', 
        'price', 
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

}
