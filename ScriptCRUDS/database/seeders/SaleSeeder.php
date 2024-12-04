<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    public function run()
    {
        DB::table('sales')->insert([
            array (
                'car_id' => '1',
                'customer_id' => '1',
                'employee_id' => '1',
                'date' => '2024-01-15',
                'quantity' => '1',
                'total' => '20000.00'
            ),
            array (
                'car_id' => '3',
                'customer_id' => '2',
                'employee_id' => '2',
                'date' => '2024-02-10',
                'quantity' => '1',
                'total' => '35000.00'
            ),
            array (
                'car_id' => '2',
                'customer_id' => '3',
                'employee_id' => '1',
                'date' => '2024-03-05',
                'quantity' => '1',
                'total' => '18000.00'
            )
        ]);
    }
}