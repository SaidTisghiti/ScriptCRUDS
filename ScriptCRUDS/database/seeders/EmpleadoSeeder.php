<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpleadoSeeder extends Seeder
{
    public function run()
    {
        DB::table('empleados')->insert([
            array (
                'nombre' => 'Luis Fernández',
                'puesto' => 'Vendedor',
                'salario' => '2500.00'
            ),
            array (
                'nombre' => 'Ana Sánchez',
                'puesto' => 'Gerente',
                'salario' => '4000.00'
            ),
            array (
                'nombre' => 'Pedro Morales',
                'puesto' => 'Mecánico',
                'salario' => '3000.00'
            )
        ]);
    }
}