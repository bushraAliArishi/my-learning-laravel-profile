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
        $title     = $this->faker->jobTitle();
        $startDate = $this->faker->dateTimeBetween('-5 years', 'now');
        $endDate   = $this->faker->dateTimeBetween($startDate, 'now');

        return [
            'slug'        => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1, 1000),
            'title'       => $title,
            'company'     => $this->faker->company(),
            'period'      => $startDate->format('M Y') . ' – ' . $endDate->format('M Y'),
            'details'     => $this->faker->paragraph(),
            'start_date'  => $startDate->format('Y-m-d'),
            'end_date'    => $endDate->format('Y-m-d'),
        ];
    }

    /**
     * Attach related skills, achievements, and tools.
     */
    public function withRelations(int $skillsCount = 3, int $achievementsCount = 2, int $toolsCount = 4)
    {
        return $this
            ->has(\App\Models\ExperienceSkill::factory()->count($skillsCount), 'skills')
            ->has(\App\Models\ExperienceAchievement::factory()->count($achievementsCount), 'achievements')
            ->hasAttached(\App\Models\Tool::factory()->count($toolsCount), 'tools');
    }
}
