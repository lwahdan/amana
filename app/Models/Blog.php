<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * 
 *
 * @property int $id
 * @property int $service_id
 * @property string $writer_type
 * @property int $writer_id
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property string $content
 * @property string $status
 * @property int $views
 * @property \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogLike> $likes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogComment> $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogFavorite> $favorites
 * @property-read int|null $favorites_count
 * @property-read int|null $likes_count
 * @property-read \App\Models\Service|null $service
 * @property-read Model|\Eloquent $writer
 * @method static \Database\Factories\BlogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereLikes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereWriterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereWriterType($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['service_id', 'writer_id', 'writer_type', 'title', 'description', 'image', 'content', 'status', 'views', 'likes'];

    public function writer()
    {
        return $this->morphTo();
    }

    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    public function favorites()
    {
        return $this->hasMany(BlogFavorite::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function likes()
    {
        return $this->hasMany(BlogLike::class);
    }

    public function getWriterTypeNameAttribute()
    {
        return match (class_basename($this->writer_type)) {
            'User' => 'User',
            'Provider' => 'Provider',
            'Admin' => 'Administrator',
            default => 'Unknown',
        };
    }
}
