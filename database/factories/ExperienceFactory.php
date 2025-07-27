<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\ExperienceAchievement;
use App\Models\ExperienceSkill;
use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExperienceFactory extends Factory
{
    protected $model = Experience::class;

    public function definition(): array
    {
        $title = $this->faker->jobTitle();
        $startDate = $this->faker->dateTimeBetween('-5 years', 'now');
        $endDate = $this->faker->dateTimeBetween($startDate, 'now');

        return [
            'slug' => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'title' => $title,
            'company' => $this->faker->company(),
            'period' => $startDate->format('M Y') . ' – ' . $endDate->format('M Y'),
            'details' => $this->faker->paragraph(),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ];
    }

    /**
     * Attach related skills, achievements, and tools.
     */
    public function withRelations(int $skillsCount = 3, int $achievementsCount = 2, int $toolsCount = 4)
    {
        return $this
            ->has(ExperienceSkill::factory()->count($skillsCount), 'skills')
            ->has(ExperienceAchievement::factory()->count($achievementsCount), 'achievements')
            ->hasAttached(Tool::factory()->count($toolsCount), 'tools');
    }
}
