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
        Experience::factory()
            ->count(20)
            ->has(
                ExperienceSkill::factory()->count(3),
                'skills'
            )
            ->has(
                ExperienceAchievement::factory()->count(2),
                'achievements'
            )
            ->hasAttached(
                Tool::factory()->count(4),
                [],   
                'tools'
                )
            ->create();

        Project::factory()
            ->count(20)
            ->has(
                ProjectMedia::factory()->count(3),
                'media'
            )
            ->hasAttached(
                Tag::factory()->count(5),
                [],   
                'tags' 

                )

                ->hasAttached(
                Tool::factory()->count(4),
                [],
                'tools'
            )
            ->create();
    }
}
