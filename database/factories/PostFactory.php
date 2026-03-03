<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PostFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array<string, mixed>
	 */
	public function definition(): array
	{
		$title = fake()->sentence(6);

		return [
			'user_id' => User::factory(),
			'category_id' => Category::factory(),
			'title' => $title,
			'slug' => str()->slug($title) . '-' . fake()->unique()->numberBetween(100, 999),
			'content' => fake()->paragraphs(4, true),
			'published' => fake()->boolean(70),
		];
	}
}
