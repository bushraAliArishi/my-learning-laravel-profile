<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\ExperienceSkill;
use App\Models\ExperienceAchievement;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
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

    /**
     * Indicate that this factory should create related skills, achievements, and tools.
     *
     * @param  int  $skillsCount
     * @param  int  $achievementsCount
     * @param  int  $toolsCount
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function withRelations(int $skillsCount = 3, int $achievementsCount = 2, int $toolsCount = 4)
    {
        return $this
            ->has(ExperienceSkill::factory()->count($skillsCount), 'skills')
            ->has(ExperienceAchievement::factory()->count($achievementsCount), 'achievements')
            ->hasAttached(Tool::factory()->count($toolsCount), 'tools', []);
    }
}
