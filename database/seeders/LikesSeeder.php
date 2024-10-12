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

        foreach (range(1, 100) as $index) { // Create 100 likes
            $userId = $faker->numberBetween(1, 10); // Assuming you have 10 users
            $postId = $faker->numberBetween(1, 30); // Assuming you have 30 posts

            // Check if like already exists
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
