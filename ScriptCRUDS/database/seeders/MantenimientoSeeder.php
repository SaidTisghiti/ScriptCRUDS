<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MantenimientoSeeder extends Seeder
{
    public function run()
    {
        DB::table('mantenimientos')->insert([
            array (
                'coche_id' => '1',
                'empleado_id' => '3',
                'descripcion' => 'Cambio de aceite y filtro',
                'fecha' => '2024-01-20',
                'costo' => '150.00'
            ),
            array (
                'coche_id' => '2',
                'empleado_id' => '3',
                'descripcion' => 'Revisión de frenos',
                'fecha' => '2024-02-15',
                'costo' => '200.00'
            ),
            array (
                'coche_id' => '3',
                'empleado_id' => '3',
                'descripcion' => 'Cambio de neumáticos',
                'fecha' => '2024-03-01',
                'costo' => '400.00'
            )
        ]);
    }
}