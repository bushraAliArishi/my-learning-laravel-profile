<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'PHP', 'color_hex' => '#777BB4'],
            ['name' => 'Laravel', 'color_hex' => '#FF2D20'],
            ['name' => 'JavaScript', 'color_hex' => '#F7DF1E'],
            ['name' => 'Vue.js', 'color_hex' => '#42B883'],
            ['name' => 'Tailwind', 'color_hex' => '#38B2AC'],
        ];

        foreach ($tags as $data) {
            Tag::updateOrCreate(
                ['name' => $data['name']],
                ['color_hex' => $data['color_hex']]
            );
        }
    }
}
