<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            array (
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '123456789',
                'address' => '123 Fake Street'
            ),
            array (
                'name' => 'Mary Johnson',
                'email' => 'mary.johnson@example.com',
                'phone' => '987654321',
                'address' => '456 Central Avenue'
            ),
            array (
                'name' => 'Carlos Brown',
                'email' => 'carlos.brown@example.com',
                'phone' => '654321987',
                'address' => '789 Sunshine Street'
            )
        ]);
    }
}