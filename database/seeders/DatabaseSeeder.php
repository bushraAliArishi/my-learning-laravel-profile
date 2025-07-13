<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       $this->call([
        TagSeeder::class,
        ToolSeeder::class,
    ]);


    $this->call([
        ProjectSeeder::class,
        ExperienceSeeder::class,
    ]);

    $this->call([
        FactorySeeder::class,
    ]);

         User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'first_name'     => 'Test',
                'last_name'      => 'User',
                'username'       => 'testuser',
                'password'       => bcrypt('password'),
                'remember_token' => Str::random(10),
            ]
        );
    }
}
