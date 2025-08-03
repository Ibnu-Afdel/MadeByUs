<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'avatar' => fake()->boolean(60) ? fake()->imageUrl(200, 200, 'people') : null,
            'provider' => null,
            'provider_id' => null,
        ];
    }

    /**
     * Indicate that the user is a social login user.
     */
    public function socialLogin(string $provider = 'github'): static
    {
        return $this->state(fn (array $attributes) => [
            'provider' => $provider,
            'provider_id' => fake()->unique()->numerify('########'),
            'password' => null,
        ]);
    }

    /**
     * Indicate that the user has an avatar.
     */
    public function withAvatar(): static
    {
        return $this->state(fn (array $attributes) => [
            'avatar' => fake()->imageUrl(200, 200, 'people'),
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
