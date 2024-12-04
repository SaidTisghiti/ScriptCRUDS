<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        DB::table('employees')->insert([
            array (
                'name' => 'Luis Fernandez',
                'position' => 'Salesperson',
                'salary' => '2500.00'
            ),
            array (
                'name' => 'Ana Sanchez',
                'position' => 'Manager',
                'salary' => '4000.00'
            ),
            array (
                'name' => 'Pedro Morales',
                'position' => 'Mechanic',
                'salary' => '3000.00'
            )
        ]);
    }
}