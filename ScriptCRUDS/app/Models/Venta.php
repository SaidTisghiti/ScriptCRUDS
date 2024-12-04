<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas'; // Tabla asociada

    protected $fillable = [
        'id',
        'coche_id',
        'cliente_id',
        'empleado_id',
        'fecha',
        'cantidad',
        'total',
        'NOT'
    ];

    
    public function Coch()
    {
        return $this->belongsTo(Coch::class, 'coche_id', 'id');
    }
    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
    public function Empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id', 'id');
    }
}