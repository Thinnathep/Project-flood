<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class SafePlacesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('th_TH'); // ใช้ Faker สำหรับภาษาไทย

        $places = [
            [
                'name' => 'บ้านปลอดภัย 1',
                'address' => '123 ถนนปลอดภัย',
                'city' => 'เชียงใหม่',
                'state' => 'เชียงใหม่',
                'latitude' => 18.7885,
                'longitude' => 98.9853,
                'description' => 'สถานที่ปลอดภัยสำหรับฉุกเฉิน',
            ],
            [
                'name' => 'ศูนย์ช่วยเหลือ 1',
                'address' => '456 ถนนความปลอดภัย',
                'city' => 'ลำปาง',
                'state' => 'ลำปาง',
                'latitude' => 18.2903,
                'longitude' => 99.5072,
                'description' => 'ศูนย์ช่วยเหลือในกรณีฉุกเฉิน',
            ],
            [
                'name' => 'ที่ทำการกู้ภัย 1',
                'address' => '789 ถนนกู้ภัย',
                'city' => 'พิษณุโลก',
                'state' => 'พิษณุโลก',
                'latitude' => 16.8275,
                'longitude' => 100.2647,
                'description' => 'ที่ทำการกู้ภัยในพื้นที่',
            ],
        ];

        // เพิ่มข้อมูลด้วย Faker
        for ($i = 0; $i < 20; $i++) {
            $places[] = [
                'name' => $faker->company . ' ' . ($i + 1),
                'address' => $faker->address,
                'city' => $faker->city,
                'state' => 'ภาคเหนือ',
                'latitude' => $faker->latitude,
                'longitude' => $faker->longitude,
                'description' => $faker->sentence,
            ];
        }

        DB::table('safe_places')->insert($places);
    }
}
