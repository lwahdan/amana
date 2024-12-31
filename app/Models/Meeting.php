<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $provider_id
 * @property \Illuminate\Support\Carbon $meeting_date
 * @property string|null $meeting_link
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Provider|null $provider
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereMeetingLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meeting whereUserId($value)
 * @mixin \Eloquent
 */
class Meeting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'provider_id',
        'meeting_date',
        'meeting_link',
        'status',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
