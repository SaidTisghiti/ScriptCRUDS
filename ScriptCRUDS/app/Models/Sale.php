<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales'; // Tabla asociada

    protected $fillable = [
        'id',
        'car_id',
        'customer_id',
        'employee_id',
        'date',
        'quantity',
        'total',
        'NOT'
    ];

    
    public function Car()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}