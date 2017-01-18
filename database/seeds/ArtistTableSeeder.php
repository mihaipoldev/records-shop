<?php

use App\Models\Artist;
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

		$artist = new Artist();
		$artist->name = 'Cristi Cons';
		$artist->save();

		$artist = new Artist();
		$artist->name = 'Mihai Pol';
		$artist->save();

		$artist = new Artist();
		$artist->name = 'Suolo';
		$artist->save();
	}
}
