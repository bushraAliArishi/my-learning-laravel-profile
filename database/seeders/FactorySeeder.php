<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Tag::factory()->count(20)->create();
        \App\Models\Tool::factory()->count(20)->create();
        \App\Models\Experience::factory()->count(20)->withRelations(3,2,4)->create();
        \App\Models\Project::factory()->count(20)->withRelations(2,3,4)->create();
    }
}
