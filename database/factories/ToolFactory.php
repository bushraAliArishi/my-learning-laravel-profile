<?php

namespace Database\Factories;

use App\Models\Tool;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tool::class;

    /**
     * Define the model's default state.
     *
     * @return array<string,mixed>
     */
    public function definition(): array
    {
        // قائمة روابط الأيقونات (خارجية ومحلية)
        $iconOptions = [
            'https://www.gstatic.com/images/branding/product/1x/admin_48dp.png',
            'https://bubble.io/images/homepage/logo-bubble.svg',
            'images/logos/notion-logo-svgrepo-com.svg',
            'images/logos/trello-logo-svgrepo-com.svg',
            'images/logos/lucidchart.svg',
            // أضف أي روابط أيقونات أخرى لديك
        ];

        return [
            // اسم فريد سيتم توليده من faker
            'name' => $this->faker->unique()->company(),
            // اختر أيقونة عشوائية من القائمة
            'logo' => $this->faker->randomElement($iconOptions),
        ];
    }
}
