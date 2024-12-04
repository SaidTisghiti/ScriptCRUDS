<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    public function run()
    {
        DB::table('cars')->insert([
            array (
                'brand' => 'Toyota',
                'model' => 'Corolla',
                'year' => '2021',
                'price' => '20000.00',
                'color' => 'Red',
                'stock' => '5'
            ),
            array (
                'brand' => 'Ford',
                'model' => 'Focus',
                'year' => '2020',
                'price' => '18000.00',
                'color' => 'Blue',
                'stock' => '3'
            ),
            array (
                'brand' => 'BMW',
                'model' => 'Series 3',
                'year' => '2022',
                'price' => '35000.00',
                'color' => 'Black',
                'stock' => '2'
            ),
            array (
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => '2021',
                'price' => '22000.00',
                'color' => 'White',
                'stock' => '4'
            ),
            array (
                'brand' => 'Audi',
                'model' => 'A4',
                'year' => '2023',
                'price' => '40000.00',
                'color' => 'Gray',
                'stock' => '1'
            )
        ]);
    }
}