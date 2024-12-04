<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance'; // Tabla asociada

    protected $fillable = [
        'id',
        'car_id',
        'employee_id',
        'description',
        'date',
        'cost',
        'NOT'
    ];

    
    public function Car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}