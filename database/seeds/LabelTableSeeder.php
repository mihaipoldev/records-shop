<?php

use App\Helpers\Helper;
use App\Models\Label;
use Illuminate\Database\Seeder;

class LabelTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$name = 'Capodopere';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Synesthesia';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Substantia Nigra';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Amphia';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Meander';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

		$name = 'Dialegestai';
		Label::create([
			'name' => $name,
			'slug' => Helper::slugify($name),
		]);

	}
}
