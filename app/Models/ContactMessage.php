<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $subject
 * @property string $message
 * @property int|null $user_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContactMessage whereUserId($value)
 * @mixin \Eloquent
 */
class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'subject', 
        'message', 
        'user_id', 
        'status'
    ];

    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
