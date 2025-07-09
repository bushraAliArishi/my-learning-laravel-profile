<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\ExperienceAchievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceAchievementFactory extends Factory
{
    protected $model = ExperienceAchievement::class;

    public function definition()
    {
        return [
            'experience_id' => Experience::factory(),
            'description'   => $this->faker->sentence(),
        ];
    }
}
