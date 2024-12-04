<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees'; // Tabla asociada

    protected $fillable = [
        'id',
        'name',
        'position',
        'salary',
        'NOT'
    ];

    
    public function sales()
    {
        return $this->hasMany(Sale::class, 'employees_id', 'id');
    }
    public function maintenance()
    {
        return $this->hasMany(Maintenance::class, 'employees_id', 'id');
    }
}