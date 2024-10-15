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

        // โพสต์เกี่ยวกับปัญหาหรือสาระ
        $topics = [
            'ปัญหาความรัก',
            'สาระน่ารู้เกี่ยวกับการดูแลสุขภาพ',
            'เคล็ดลับการทำอาหาร',
            'การแก้ปัญหาการเงิน',
            'ประสบการณ์เที่ยวต่างประเทศ',
            'การเลือกซื้อของออนไลน์',
            'ปัญหาทางเทคนิคที่พบบ่อย',
            'เทคนิคการเรียนรู้ภาษาใหม่',
            'การบริหารเวลาให้มีประสิทธิภาพ',
            'แนะนำหนังสือที่น่าสนใจ',
            'ปัญหาสุขภาพจิต',
            'การดูแลสัตว์เลี้ยง',
            'การแก้ปัญหาครอบครัว',
            'เรื่องราวที่น่าติดตามจากข่าว',
            'วิธีการผ่อนคลายความเครียด',
            'เทรนด์แฟชั่นในปีนี้',
            'การดูแลบ้านให้สะอาด',
            'ความรู้เกี่ยวกับการลงทุน',
            'เทคนิคการทำงานจากที่บ้าน',
            'ประสบการณ์การศึกษาในต่างประเทศ'
        ];

        // สร้างโพสต์
        foreach (range(1, 20) as $index) {
            $postId = DB::table('forum_posts')->insertGetId([
                'user_id' => $faker->numberBetween(1, 10), // สมมติว่ามีผู้ใช้ 10 คน
                'title' => $faker->randomElement($topics), // สุ่มหัวข้อจาก $topics
                'content' => $faker->paragraphs($faker->numberBetween(2, 5), true), // สุ่มเนื้อหาจาก Faker
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // สร้างคอมเมนต์สำหรับแต่ละโพสต์
            foreach (range(1, $faker->numberBetween(0, 5)) as $commentIndex) {
                DB::table('comments')->insert([
                    'forum_post_id' => $postId, // Updated to forum_post_id
                    'user_id' => $faker->numberBetween(1, 10), // สุ่มผู้ใช้ที่คอมเมนต์
                    'content' => $faker->sentence($faker->numberBetween(6, 12)), // สุ่มเนื้อหาคอมเมนต์
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
