<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Tag;

class ProjectTagPivotSeeder extends Seeder
{
    public function run(): void
    {
        Project::all()->each(function($project) {
            // خذي 1–3 تاقات عشوائية لكل مشروع
            $tagIds = Tag::inRandomOrder()
                         ->take(rand(1, 3))
                         ->pluck('id')
                         ->toArray();

            $project->tags()->sync($tagIds);
        });
    }
}
