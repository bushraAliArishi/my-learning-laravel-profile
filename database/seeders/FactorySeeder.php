<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Tool;
use App\Models\Tag;
use App\Models\ExperienceSkill;
use App\Models\ExperienceAchievement;
use App\Models\ProjectMedia;

class FactorySeeder extends Seeder
{
    public function run(): void
    {
        // ==== تجريبيّات الخبرات ====
        Experience::factory()
            ->count(20)
            // أنشئ 3 مهارات لكل تجربة
            ->has(
                ExperienceSkill::factory()->count(3),
                'skills'
            )
            // أنشئ 2 إنجاز لكل تجربة
            ->has(
                ExperienceAchievement::factory()->count(2),
                'achievements'
            )
            // اربط 4 أدوات عشوائية (يُنشئها أولا إذا لزم)
            ->hasAttached(
                Tool::factory()->count(4),
                [],     // هنا يمكن تمرير بيانات pivot إضافيّة
                'tools' // اسم العلاقة many-to-many على الموديل Experience
            )
            ->create();

        // ==== تجريبيّات المشاريع ====
        Project::factory()
            ->count(20)
            // أنشئ 3 وسائط (صور/فيديو) لكل مشروع
            ->has(
                ProjectMedia::factory()->count(3),
                'media'
            )
            // اربط 5 تاقات عشوائية (يُنشئها أولا إذا لزم)
            ->hasAttached(
                Tag::factory()->count(5),
                [],     // بيانات pivot (مثل color_hex) يمكن ملؤها هنا إن أردت
                'tags'  // اسم العلاقة many-to-many على الموديل Project
            )
            // اربط 4 أدوات عشوائية
            ->hasAttached(
                Tool::factory()->count(4),
                [],
                'tools'
            )
            ->create();
    }
}
