<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('accounts')->insert([
            ['id' => 1, 'username' => 'thaytien', 'password' => '123456', 'name' => 'thầy Tiến', 'bridthday' => NULL, 'img' => '', 'islike' => 0, 'status' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'username' => 'thayhao', 'password' => '123456', 'name' => 'thầy Hảo', 'bridthday' => NULL, 'img' => '', 'islike' => 0, 'status' => 1, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'username' => 'thaykhacanh', 'password' => '123456', 'name' => 'thầy khắc Anh', 'bridthday' => NULL, 'img' => '', 'islike' => 0, 'status' => 1, 'created_at' => NULL, 'updated_at' => NULL],
        ]);
    }
}
