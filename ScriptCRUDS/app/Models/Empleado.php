<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Tabla asociada

    protected $fillable = [
        'id',
        'nombre',
        'puesto',
        'salario',
        'NOT'
    ];

    
    public function ventas()
    {
        return $this->hasMany(Venta::class, 'empleados_id', 'id');
    }
    public function mantenimientos()
    {
        return $this->hasMany(Mantenimiento::class, 'empleados_id', 'id');
    }
}