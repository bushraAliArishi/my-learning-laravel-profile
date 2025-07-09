<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \App\Models\User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $first = $this->faker->firstName();
        $last  = $this->faker->lastName();

        return [
            'first_name'        => $first,
            'last_name'         => $last,
            'username'          => Str::slug("{$first} {$last}") . rand(1, 999),
            'phone'             => $this->faker->phoneNumber(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
        ];
    }
}
