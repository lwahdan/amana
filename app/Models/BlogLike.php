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
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike whereBlogId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogLike whereUserId($value)
 * @mixin \Eloquent
 */
class BlogLike extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id', 
        'blog_id',
    ];

    /**
     * Get the blog associated with this like.
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Get the user who liked the blog.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
