<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'エンゲルス', 'email' => 'engels@example.com', 'password' => Hash::make('password')],
            ['name' => 'ゴルバチョフ', 'email' => 'gorbachev@example.com', 'password' => Hash::make('password')],
            ['name' => 'スターリン', 'email' => 'stalin@example.com', 'password' => Hash::make('password')],
            ['name' => 'フルシチョフ', 'email' => 'khrushchev@example.com', 'password' => Hash::make('password')],
            ['name' => 'マルクス', 'email' => 'marx@example.com', 'password' => Hash::make('password')],
            ['name' => 'レーニン', 'email' => 'lenin@example.com', 'password' => Hash::make('password')]
        ];

        DB::table('users')->insert($users);
    }
}
