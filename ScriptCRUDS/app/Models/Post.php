<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts'; // Tabla asociada

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'content',
        'created_at',
        'updated_at'
    ];

    
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'posts_id', 'id');
    }
}