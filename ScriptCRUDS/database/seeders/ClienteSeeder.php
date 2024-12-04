<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        DB::table('clientes')->insert([
            array (
                'nombre' => 'Juan Pérez',
                'email' => 'juan.perez@example.com',
                'telefono' => '123456789',
                'direccion' => 'Calle Falsa 123'
            ),
            array (
                'nombre' => 'María López',
                'email' => 'maria.lopez@example.com',
                'telefono' => '987654321',
                'direccion' => 'Avenida Central 456'
            ),
            array (
                'nombre' => 'Carlos García',
                'email' => 'carlos.garcia@example.com',
                'telefono' => '654321987',
                'direccion' => 'Calle del Sol 789'
            )
        ]);
    }
}