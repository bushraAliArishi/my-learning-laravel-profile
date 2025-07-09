<?php

namespace Database\Factories;

use App\Models\Experience;
use App\Models\ExperienceSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceSkillFactory extends Factory
{
    protected $model = ExperienceSkill::class;

    public function definition()
    {
        return [
            'experience_id' => Experience::factory(),
            'skill_name'    => $this->faker->sentence(3),
        ];
    }
}
