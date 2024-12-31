<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $blog_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Blog|null $blog
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogFavorite whereUserId($value)
 * @mixin \Eloquent
 */
class BlogFavorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
