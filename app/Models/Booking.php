<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'city_id', 
        'booking_date', 
        'total_price',
        'status', 
        'shift',
    ];

    protected $casts = [
        'booking_date' => 'datetime',
    ];
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function service()
    {
    return $this->belongsTo(Service::class);
    }

    public function provider()
    {
    return $this->belongsTo(Provider::class);
    }

    public function city()
    {
    return $this->belongsTo(City::class);
    }

}
