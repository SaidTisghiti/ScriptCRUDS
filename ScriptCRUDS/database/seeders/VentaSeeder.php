<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VentaSeeder extends Seeder
{
    public function run()
    {
        DB::table('ventas')->insert([
            array (
                'coche_id' => '1',
                'cliente_id' => '1',
                'empleado_id' => '1',
                'fecha' => '2024-01-15',
                'cantidad' => '1',
                'total' => '20000.00'
            ),
            array (
                'coche_id' => '3',
                'cliente_id' => '2',
                'empleado_id' => '2',
                'fecha' => '2024-02-10',
                'cantidad' => '1',
                'total' => '35000.00'
            ),
            array (
                'coche_id' => '2',
                'cliente_id' => '3',
                'empleado_id' => '1',
                'fecha' => '2024-03-05',
                'cantidad' => '1',
                'total' => '18000.00'
            )
        ]);
    }
}