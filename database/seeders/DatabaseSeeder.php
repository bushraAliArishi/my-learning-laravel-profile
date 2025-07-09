<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Static reference data
        $this->call([
            TagSeeder::class,
            ToolSeeder::class,
            ExperienceSeeder::class,
            ExperienceSkillsTableSeeder::class,
            ExperienceAchievementsTableSeeder::class,
            ExperienceToolTableSeeder::class,
            ProjectSeeder::class,
            ProjectMediaTableSeeder::class,
            ProjectToolTableSeeder::class,
        ]);

        // 2) Bulk factories
        $this->call([
            FactorySeeder::class,
        ]);

        // 3) Test user
        \App\Models\User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name'     => 'Test',
                'last_name'      => 'User',
                'username'       => 'testuser',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
