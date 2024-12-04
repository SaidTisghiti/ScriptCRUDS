<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coch extends Model
{
    use HasFactory;

    protected $table = 'coches'; // Tabla asociada

    protected $fillable = [
        'id',
        'marca',
        'modelo',
        'o',
        'precio',
        'NOT',
        'color',
        'stock'
    ];

    
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'coches_id', 'id');
    }
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'coches_id', 'id');
    }
}