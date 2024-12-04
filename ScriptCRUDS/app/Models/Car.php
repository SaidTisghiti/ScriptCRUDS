<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars'; // Tabla asociada

    protected $fillable = [
        'id',
        'brand',
        'model',
        'year',
        'price',
        'NOT',
        'color',
        'stock'
    ];

    
    public function sales()
    {
        return $this->hasMany(Sale::class, 'cars_id', 'id');
    }
    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'cars_id', 'id');
    }
}