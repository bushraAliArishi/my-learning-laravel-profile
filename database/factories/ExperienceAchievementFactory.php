<?php

namespace Database\Factories;

use App\Models\ExperienceAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceAchievementFactory extends Factory
{
    protected $model = ExperienceAchievement::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(),
        ];
    }
}
