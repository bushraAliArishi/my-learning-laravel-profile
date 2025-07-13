<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToolFactory extends Factory
{
    protected $model = Tool::class;

    public function definition(): array
    {
        $icons = [
            'images/logos/google-icon-logo-svgrepo-com.svg',
            'images/logos/Bubble_Logo_no_code.svg',
            'images/logos/notion-logo-svgrepo-com.svg',
            'images/logos/trello-logo-svgrepo-com.svg',
            'images/logos/lucidchart.svg',
        ];

        return [
            'name' => $this->faker->unique()->company(),
            'logo' => $this->faker->randomElement($icons),
        ];
    }
}
