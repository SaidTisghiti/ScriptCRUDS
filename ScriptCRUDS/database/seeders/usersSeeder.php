<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([

        ]);
    }
}