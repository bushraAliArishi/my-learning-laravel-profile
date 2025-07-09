<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMediaFactory extends Factory
{
    protected $model = ProjectMedia::class;

    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            // adjust to your real storage path
            'media_url'  => 'images/logos/' . $this->faker->lexify('media-????') . '.svg',
            'media_type' => $this->faker->randomElement(['image','video']),
        ];
    }
}
