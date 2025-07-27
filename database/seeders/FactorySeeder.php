<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\ExperienceAchievement;
use App\Models\ExperienceSkill;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\Tag;
use App\Models\Tool;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    public function run(): void
    {
        // 1) أنشئ 20 تاق جديدة
        Tag::factory()->count(20)->create();

        // 2) أنشئ 20 تول جديدة
        Tool::factory()->count(20)->create();

        // 3) جنّـر الـ Experiences مع علاقاتها
        Experience::factory()
            ->count(20)
            ->has(ExperienceSkill::factory()->count(3), 'skills')
            ->has(ExperienceAchievement::factory()->count(2), 'achievements')
            ->create()
            ->each(function ($exp) {
                // اربط لكل تجربة من 3 إلى 6 أدوات عشوائية
                $toolIds = Tool::inRandomOrder()
                    ->take(rand(3, 6))
                    ->pluck('id');
                $exp->tools()->sync($toolIds);
            });

        // 4) جنّـر المشاريع مع الميديا
        Project::factory()
            ->count(20)
            ->has(ProjectMedia::factory()->count(3), 'media')
            ->create()
            ->each(function ($proj) {
                // اربط لكل مشروع من 1 إلى 5 تاقات عشوائية
                $tagIds = Tag::inRandomOrder()
                    ->take(rand(1, 5))
                    ->pluck('id');
                $proj->tags()->sync($tagIds);

                // اربط لكل مشروع من 2 إلى 6 أدوات عشوائية
                $toolIds = Tool::inRandomOrder()
                    ->take(rand(2, 6))
                    ->pluck('id');
                $proj->tools()->sync($toolIds);
            });
    }
}
