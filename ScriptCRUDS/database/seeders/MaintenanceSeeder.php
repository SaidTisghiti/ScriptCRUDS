<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaintenanceSeeder extends Seeder
{
    public function run()
    {
        DB::table('maintenance')->insert([
            array (
                'car_id' => '1',
                'employee_id' => '3',
                'description' => 'Oil and filter change',
                'date' => '2024-01-20',
                'cost' => '150.00'
            ),
            array (
                'car_id' => '2',
                'employee_id' => '3',
                'description' => 'Brake inspection',
                'date' => '2024-02-15',
                'cost' => '200.00'
            ),
            array (
                'car_id' => '3',
                'employee_id' => '3',
                'description' => 'Tire replacement',
                'date' => '2024-03-01',
                'cost' => '400.00'
            )
        ]);
    }
}