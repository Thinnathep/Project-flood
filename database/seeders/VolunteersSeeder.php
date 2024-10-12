<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VolunteersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            DB::table('volunteers')->insert([
                'user_id' => $faker->numberBetween(1, 40), // สมมุติว่า user_id อยู่ในช่วง 1 ถึง 10
                'skills' => $faker->word, // สุ่มคำเป็นทักษะ
                'availability' => $faker->randomElement(['Weekdays', 'Weekends', 'Evenings']), // สุ่มวันทำงาน
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
