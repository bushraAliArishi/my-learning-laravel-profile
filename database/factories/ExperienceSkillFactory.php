<?php

namespace Database\Factories;

use App\Models\ExperienceSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceSkillFactory extends Factory
{
    protected $model = ExperienceSkill::class;

    public function definition(): array
    {
        return [
            'skill_name' => $this->faker->words(3, true),
        ];
    }
}
