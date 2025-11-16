<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // password
            'avatar' => $this->faker->imageUrl(640, 480, 'people'), // URL for a random image
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
