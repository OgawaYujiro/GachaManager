<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GachaSeeder extends Seeder
{
    
    public function run()
    {
        DB::table('gachas')->truncate();

        DB::table('gachas')->insert([
            [
                'id' => 1,
                'name' => '大吉',
                'content' => '大吉です'
            ],
            [
                'id' => 2,
                'name' => '中吉',
                'content' => '中吉です'
            ],
            [
                'id' => 3,
                'name' => '小吉',
                'content' => '小吉です'
            ],
            [
                'id' => 4,
                'name' => '末吉',
                'content' => '末吉です'
            ],
            [
                'id' => 5,
                'name' => '凶',
                'content' => '凶です'
            ],
            [
                'id' => 6,
                'name' => '大凶',
                'content' => '大凶です'
            ]
        ]);
    }
}
