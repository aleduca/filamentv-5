<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class AvatarFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$gender = fake()->randomElement(['men', 'women']);
		$number = fake()->randomNumber(2);

		return [
			'path' => "https://randomuser.me/api/portraits/{$gender}/{$number}.jpg",
		];
	}
}
