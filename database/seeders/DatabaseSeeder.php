<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\ToolSeeder;
use Database\Seeders\ExperienceSeeder;
use Database\Seeders\ExperienceSkillsTableSeeder;
use Database\Seeders\ExperienceAchievementsTableSeeder;
use Database\Seeders\ExperienceToolTableSeeder;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\ProjectMediaTableSeeder;
use Database\Seeders\ProjectTagsTableSeeder;
use Database\Seeders\ProjectToolTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1) أولاً نشغل جميع الـ seeders الخاصة بجداول الأدوات، الخبرات، المشاريع، الخ…
        $this->call([
            ToolSeeder::class,
            ExperienceSeeder::class,
            ExperienceSkillsTableSeeder::class,
            ExperienceAchievementsTableSeeder::class,
            ExperienceToolTableSeeder::class,
            ProjectSeeder::class,
            ProjectMediaTableSeeder::class,
            ProjectTagsTableSeeder::class,
            ProjectToolTableSeeder::class,
        ]);

        // 2) ثم ننشئ مستخدم تجريبي مطابق لأعمدة users الجديدة
        User::factory()->create([
            'first_name' => 'Test',
            'last_name'  => 'User',
            'username'   => 'testuser',
            'phone'      => null,
            'email'      => 'test@example.com',
            'password'   => bcrypt('password'),
        ]);
    }
}
