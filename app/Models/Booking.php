<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $service_id
 * @property int $provider_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon $booking_date
 * @property string $total_price
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $shift
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Provider|null $provider
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking query()
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereBookingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereShift($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereTotalPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Booking whereUserId($value)
 * @mixin \Eloquent
 */
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
