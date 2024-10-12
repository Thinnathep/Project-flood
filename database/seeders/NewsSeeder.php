<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $titles = [
            'เคล็ดลับการเตรียมความพร้อมสำหรับเหตุฉุกเฉิน',
            'การจัดการกับภัยพิบัติทางธรรมชาติ',
            'วิธีการป้องกันภัยพิบัติทางอัคคีภัย',
            'แนวทางในการเตรียมความพร้อมสำหรับภัยพิบัติ',
            'การฟื้นฟูหลังจากภัยพิบัติ',
            // Add more Thai titles as needed
        ];

        $contents = [
            'ในบทความนี้เราจะพูดถึงวิธีการเตรียมความพร้อมสำหรับเหตุฉุกเฉิน...',
            'การจัดการกับภัยพิบัติทางธรรมชาติสามารถช่วยให้คุณปลอดภัย...',
            'การป้องกันภัยพิบัติทางอัคคีภัยเป็นสิ่งสำคัญที่ควรให้ความสนใจ...',
            'แนวทางในการเตรียมความพร้อมสำหรับภัยพิบัติมีหลายวิธี...',
            'หลังจากเกิดภัยพิบัติ การฟื้นฟูเป็นสิ่งสำคัญที่ไม่ควรมองข้าม...',
            // Add more Thai contents as needed
        ];

        foreach (range(1, 30) as $index) {
            DB::table('news')->insert([
                'title' => $titles[array_rand($titles)],
                'content' => $contents[array_rand($contents)],
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
