<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // マルクスのユーザーIDを取得
        $marxId = DB::table('users')->where('name', 'マルクス')->value('id');
        // レーニンのユーザーIDを取得
        $leninId = DB::table('users')->where('name', 'レーニン')->value('id');

        $now = Carbon::now();

        $posts = [
            ['user_id' => $leninId, 'content' => '御意', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '暴力によって社会の仕組みを変えるんだ、全世界の労働者よ、団結せよ', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '矛盾の中で革命が起き、革命によって社会は進歩する', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '社会における物質と精神は、やがて矛盾を生む', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '金持ちは我々の精神をコントロールすることができる', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '社会における物質が、その社会の仕組みを規定する', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => '物質が精神を規定する', 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $marxId, 'content' => 'この世には物質しか存在しない', 'created_at' => $now, 'updated_at' => $now]
        ];

        DB::table('posts')->insert($posts);
    }
}
