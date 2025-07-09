<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectTagFactory extends Factory
{
    protected $model = ProjectTag::class;

    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'tag'        => $this->faker->unique()->word(),
            'color_hex'  => $this->faker->hexColor(),
        ];
    }
}
