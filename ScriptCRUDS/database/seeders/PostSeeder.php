<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    public function run()
    {
        DB::table('posts')->insert([
            array (
                'user_id' => '1',
                'title' => 'Primer Post',
                'content' => 'Contenido del primer post'
            ),
            array (
                'user_id' => '2',
                'title' => 'Segundo Post',
                'content' => 'Contenido del segundo post'
            ),
            array (
                'user_id' => '3',
                'title' => 'Tercer Post',
                'content' => 'Contenido del tercer post'
            )
        ]);
    }
}