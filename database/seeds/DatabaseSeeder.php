<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('band_artist')->delete();
		DB::table('track_artist')->delete();
		DB::table('record_artist')->delete();
		DB::table('record_track')->delete();
		DB::table('tracks')->delete();
		DB::table('records')->delete();
		DB::table('labels')->delete();
		DB::table('artists')->delete();

		$this->call(ArtistTableSeeder::class);
		$this->call(LabelTableSeeder::class);
		$this->call(RecordTableSeeder::class);
	}
}
