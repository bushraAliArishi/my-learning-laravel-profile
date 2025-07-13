<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $title = $this->faker->jobTitle();
        return [
            'slug'    => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'title'   => $title,
            'company' => $this->faker->company(),
            'period'  => $this->faker->date('M Y') . ' – ' . $this->faker->date('M Y'),
            'details' => $this->faker->paragraph(),
        ];
    }

    public function withRelations(int $skills = 3, int $achievements = 2, int $tools = 4)
    {
        return $this
            ->has(ExperienceSkillFactory::new()->count($skills), 'skills')
            ->has(ExperienceAchievementFactory::new()->count($achievements), 'achievements')
            ->hasAttached(ToolFactory::new()->count($tools), 'tools');
    }
}
