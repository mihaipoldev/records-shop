<?php

use Illuminate\Database\Seeder;

class ArtistTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('artists')->delete();

		$artist = new \App\Models\Artist([
			'name' => 'Cristi Cons',
		]);
		$artist->save();

		$artist = new \App\Models\Artist();
		$artist->name = 'Mihai Pol';
		$artist->save();

		$artist = new \App\Models\Artist();
		$artist->name = 'Suolo';
		$artist->save();
	}
}
