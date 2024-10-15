<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            PersonalAccessTokensSeeder::class,
            SafePlacesSeeder::class,
            ReportsSeeder::class,
            WaterReportSeeder::class,
            VolunteersSeeder::class,
            ForumPostsSeeder::class,
            LikesSeeder::class,
            CommentSeeder::class,
            NewsSeeder::class,
            ContactsSeeder::class,
            RequestSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
