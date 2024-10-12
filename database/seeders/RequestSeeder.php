<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Request;

class RequestSeeder extends Seeder
{
    public function run()
    {
        Request::create([
            'user_id' => 1,
            'name' => 'John Doe',
            'address' => '123 Main St, Bangkok',
            'phone_number' => '0123456789',
            'status' => 'pending',
            'description' => 'Need assistance due to flooding',
        ]);
    }
}
