<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewUser extends Model
{
    use HasFactory;

    protected $table = 'new_users'; // Tabla asociada

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'created_at',
        'updated_at'
    ];

    
    public function posts()
    {
        return $this->hasMany(Post::class, 'new_users_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'new_users_id', 'id');
    }
}