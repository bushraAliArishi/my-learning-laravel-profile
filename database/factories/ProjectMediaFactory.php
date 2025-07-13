<?php

namespace Database\Factories;

use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMediaFactory extends Factory
{
    protected $model = ProjectMedia::class;

    public function definition(): array
    {
        return [
            'media_url'  => 'images/logos/' . $this->faker->lexify('media-????') . '.svg',
            'media_type' => 'image',
        ];
    }
}
