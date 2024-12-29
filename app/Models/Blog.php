<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

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

    public function likes(){
        return $this->hasMany(BlogLike::class);
    }

}
