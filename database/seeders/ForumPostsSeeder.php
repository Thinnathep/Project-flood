<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ForumPostsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('th_TH'); // ใช้ locale ภาษาไทย

        foreach (range(1, 30) as $index) {
            DB::table('forum_posts')->insert([
                'user_id' => $faker->numberBetween(1, 10), // สมมติว่ามีผู้ใช้ 10 คน
                'title' => $faker->sentence,
                'content' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
