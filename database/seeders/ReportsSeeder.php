<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportsSeeder extends Seeder
{
    public function run()
    {
        DB::table('reports')->insert([
            [
                'user_id' => 1,
                'title' => 'Flood Alert',
                'description' => 'Heavy flooding reported in the downtown area.',
                'location' => 'Downtown',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
}
