<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'service_id',
        'provider_id',
        'review', 
        'rating', 
        'status', 
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

}
