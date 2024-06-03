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
            ['name' => 'チェ・ゲバラ', 'email' => 'gorbachev@example.com', 'password' => Hash::make('password')],
            ['name' => 'シャルル・フーリエ', 'email' => 'stalin@example.com', 'password' => Hash::make('password')],
            ['name' => 'ピョートル・クロポトキン', 'email' => 'khrushchev@example.com', 'password' => Hash::make('password')],
            ['name' => 'マルクス', 'email' => 'marx@example.com', 'password' => Hash::make('password')],
            ['name' => 'レーニン', 'email' => 'lenin@example.com', 'password' => Hash::make('password')]
        ];

        DB::table('users')->insert($users);
    }
}
