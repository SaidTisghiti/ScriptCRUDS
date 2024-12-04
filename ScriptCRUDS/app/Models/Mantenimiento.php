<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mantenimiento extends Model
{
    use HasFactory;

    protected $table = 'mantenimientos'; // Tabla asociada

    protected $fillable = [
        'id',
        'coche_id',
        'empleado_id',
        'descripcion',
        'fecha',
        'costo',
        'NOT'
    ];

    
    public function Coch()
    {
        return $this->belongsTo(Coch::class, 'coche_id', 'id');
    }
    public function Empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}