<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments'; // Tabla asociada

    protected $fillable = [
        'id',
        'post_id',
        'user_id',
        'comment',
        'created_at',
        'updated_at'
    ];

    
    public function Post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}