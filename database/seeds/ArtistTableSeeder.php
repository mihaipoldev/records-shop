<?php

use App\Helpers\Helper;
use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$name = 'Mihai Pol';
		Artist::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Suciu';
		Artist::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Cristi Cons';
		Artist::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Vlad Caia';
		Artist::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Sit';
		Artist::create([
			'name' => $name,
			'band' => true,
			'slug' => Helper::slugify($name),
		])->artists()->saveMany([
			Artist::where('name', 'Cristi Cons')->first(),
			Artist::where('name', 'Vlad Caia')->first(),
		]);

		$name = 'Vlad Radu';
		Artist::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);
	}
}
