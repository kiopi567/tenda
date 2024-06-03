<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'aaaa',
            'email' => 'a@a',
            'password' => Hash::make('aaaaaaaa'), // パスワードをハッシュ化
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
