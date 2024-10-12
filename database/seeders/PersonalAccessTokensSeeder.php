<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalAccessTokensSeeder extends Seeder
{
    public function run()
    {
        DB::table('personal_access_tokens')->insert([
            [
                'tokenable_type' => 'App\Models\User',
                'tokenable_id' => 1,
                'name' => 'Test Token',
                'token' => 'exampletoken1234567890',
                'abilities' => json_encode(['*']),
                'last_used_at' => now(),
                'expires_at' => now()->addDays(30),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
}
