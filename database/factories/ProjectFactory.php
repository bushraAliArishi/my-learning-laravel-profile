<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'title' => $title,
            'link' => $this->faker->url(),
            'description' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement([
                'Backend Development',
                'No-Code Development',
                'AI Platform Development',
                'Internal Systems',
                'Project Management & No-Code',
            ]),
        ];
    }

    public function withRelations(int $media = 3, int $tags = 5, int $tools = 4)
    {
        return $this
            ->has(ProjectMediaFactory::new()->count($media), 'media')
            ->hasAttached(TagFactory::new()->count($tags), 'tags')
            ->hasAttached(ToolFactory::new()->count($tools), 'tools');
    }
}
