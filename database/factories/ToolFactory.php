<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToolFactory extends Factory
{
    protected $model = Tool::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            // you may adjust this path to match your logos folder
            'logo' => 'images/logos/' . $this->faker->lexify('logo-????') . '.svg',
        ];
    }
}
