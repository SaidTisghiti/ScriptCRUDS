<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CochSeeder extends Seeder
{
    public function run()
    {
        DB::table('coches')->insert([
            array (
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'año' => '2021',
                'precio' => '20000.00',
                'color' => 'Rojo',
                'stock' => '5'
            ),
            array (
                'marca' => 'Ford',
                'modelo' => 'Focus',
                'año' => '2020',
                'precio' => '18000.00',
                'color' => 'Azul',
                'stock' => '3'
            ),
            array (
                'marca' => 'BMW',
                'modelo' => 'Serie 3',
                'año' => '2022',
                'precio' => '35000.00',
                'color' => 'Negro',
                'stock' => '2'
            ),
            array (
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'año' => '2021',
                'precio' => '22000.00',
                'color' => 'Blanco',
                'stock' => '4'
            ),
            array (
                'marca' => 'Audi',
                'modelo' => 'A4',
                'año' => '2023',
                'precio' => '40000.00',
                'color' => 'Gris',
                'stock' => '1'
            )
        ]);
    }
}