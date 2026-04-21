<?php

namespace Database\Seeders;

use App\Models\Avatar;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	use WithoutModelEvents;

	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		/*
		|--------------------------------------------------------------------------
		| Categories
		|--------------------------------------------------------------------------
		| Criamos categorias fixas para facilitar a didática nas aulas
		*/
		$categories = Category::factory()
			->count(5)
			->create();

		/*
		|--------------------------------------------------------------------------
		| Users + Posts
		|--------------------------------------------------------------------------
		| Cada usuário terá vários posts,
		| e cada post pertencerá a uma categoria aleatória
		*/
		User::factory()
			->count(50)
			->create()
			->each(function (User $user) use ($categories) {
				Avatar::factory()->create([
					'user_id' => $user->id,
				]);

				Post::factory()
					->count(fake()->numberBetween(3, 7))
					->create([
						'user_id' => $user->id,
						'category_id' => $categories->random()->id,
					]);
			});
	}
}
