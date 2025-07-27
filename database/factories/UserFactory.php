<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $first = $this->faker->firstName();
        $last = $this->faker->lastName();
        $username = Str::slug("{$first} {$last}") . $this->faker->randomNumber(3, true);

        return [
            'first_name' => $first,
            'last_name' => $last,
            'username' => $username,
            'role' => 'viewer', // Default role
            'phone' => $this->faker->unique()->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Default test password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user's email should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Create an admin user
     */
    public function admin(): static
    {
        return $this->withRole('admin');
    }

    /**
     * Assign a specific role to the user
     */
    public function withRole(string $role): static
    {
        return $this->state(function (array $attributes) use ($role) {
            return [
                'role' => $role,
            ];
        });
    }

    /**
     * Create an editor user
     */
    public function editor(): static
    {
        return $this->withRole('editor');
    }
}
