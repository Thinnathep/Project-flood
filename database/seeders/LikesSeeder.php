<?php

namespace Database\Seeders;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class LikesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $maxPostId = DB::table('forum_posts')->max('id'); // Get the max post ID

        foreach (range(1, 100) as $index) {
            $userId = $faker->numberBetween(1, 10); // Assuming you have 10 users
            $postId = $faker->numberBetween(1, $maxPostId); // Ensure post ID exists

            if (!DB::table('likes')->where('user_id', $userId)->where('post_id', $postId)->exists()) {
                DB::table('likes')->insert([
                    'user_id' => $userId,
                    'post_id' => $postId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
