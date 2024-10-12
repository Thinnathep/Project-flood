<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;
use App\Models\User; // เรียกใช้ User Model
use Faker\Factory as Faker;

class RequestSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // สร้าง 10 ข้อมูล
        for ($i = 0; $i < 10; $i++) {
            Request::create([
                'user_id' => User::inRandomOrder()->first()->id, // สุ่ม user จากฐานข้อมูล
                'name' => $faker->name,
                'address' => $faker->address,
                'phone_number' => $faker->phoneNumber,
                'status' => 'pending', // กำหนดสถานะเป็น 'pending'
                'description' => $faker->sentence, // คำอธิบายแบบสุ่ม
                'latitude' => $faker->latitude, // สุ่มค่า latitude
                'longitude' => $faker->longitude, // สุ่มค่า longitude
            ]);
        }
    }
}
