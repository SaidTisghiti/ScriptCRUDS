<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('new_users')->insert([
            array (
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => 'password_encriptada'
            ),
            array (
                'name' => 'Usuario1',
                'email' => 'usuario1@example.com',
                'password' => 'password_encriptada'
            ),
            array (
                'name' => 'Usuario2',
                'email' => 'usuario2@example.com',
                'password' => 'password_encriptada'
            )
        ]);
    }
}