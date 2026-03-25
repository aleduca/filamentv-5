<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserFactory extends Factory
{
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
			'password' => Hash::make('123'),
			'remember_token' => Str::random(10),
			'age' => fake()->numberBetween(10, 60),
			'gender' => fake()->randomElement(['male', 'female']),
			'is_admin' => fake()->numberBetween(0, 1),
			'roles' => fake()->randomElement(['user', 'admin', 'super-admin']),
		];
	}
}
