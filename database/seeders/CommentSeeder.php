<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // จำนวนความคิดเห็นที่ต้องการ
        $numComments = 100;

        // ตรวจสอบจำนวนโพสต์ที่มีอยู่
        $maxPostId = DB::table('forum_posts')->max('id');

        foreach (range(1, $numComments) as $index) {
            DB::table('comments')->insert([
                'forum_post_id' => $faker->numberBetween(1, $maxPostId), // ใช้ค่าที่มีอยู่ในตาราง forum_posts
                'user_id' => $faker->numberBetween(1, 10), // สมมติว่ามี 10 ผู้ใช้
                'content' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // เพิ่มความคิดเห็นที่เป็นภาษาไทย
        DB::table('comments')->insert([
            [
                'forum_post_id' => 1,
                'user_id' => 1,
                'content' => 'ความคิดเห็นแรกในโพสต์ที่หนึ่ง',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'forum_post_id' => 1,
                'user_id' => 2,
                'content' => 'ความคิดเห็นที่สองในโพสต์ที่หนึ่ง',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'forum_post_id' => 2,
                'user_id' => 3,
                'content' => 'ความคิดเห็นแรกในโพสต์ที่สอง',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // เพิ่มความคิดเห็นเพิ่มเติมได้ตามต้องการ
        ]);
    }
}
