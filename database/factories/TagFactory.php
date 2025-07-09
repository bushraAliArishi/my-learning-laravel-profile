<?php
// database/factories/TagFactory.php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The model that this factory is for.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        return [
            'name'      => $this->faker->unique()->word(),
            'color_hex' => $this->faker->hexColor(),
        ];
    }
}
