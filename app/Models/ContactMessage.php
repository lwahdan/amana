<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
