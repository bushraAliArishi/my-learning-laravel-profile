<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectMedia;
use App\Models\ProjectTag;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);

        return [
            'slug'        => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'title'       => $title,
            'link'        => $this->faker->url(),
            'description' => $this->faker->paragraph(),
            'type'        => $this->faker->randomElement([
                'Backend Development',
                'No-Code Development',
                'AI Platform Development',
                'Internal Systems',
                'Project Management & No-Code',
            ]),
        ];
    }

    /**
     * Indicate that this factory should create related media, tags, and tools.
     *
     * @param  int  $mediaCount
     * @param  int  $tagsCount
     * @param  int  $toolsCount
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withRelations(int $mediaCount = 2, int $tagsCount = 3, int $toolsCount = 4)
    {
        return $this
            ->has(ProjectMedia::factory()->count($mediaCount), 'media')
            ->has(ProjectTag::factory()->count($tagsCount), 'tags')
            ->hasAttached(Tool::factory()->count($toolsCount), 'tools', []);
    }
}
