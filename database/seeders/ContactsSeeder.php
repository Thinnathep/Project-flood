<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactsSeeder extends Seeder
{
    public function run()
    {
        DB::table('contacts')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'message' => 'I need assistance with...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more records as needed
        ]);
    }
}
