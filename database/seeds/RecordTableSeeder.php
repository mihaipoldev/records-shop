<?php

use App\Models\Artist;
use App\Models\Label;
use App\Models\Record;
use Illuminate\Database\Seeder;

class RecordTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('records')->delete();

		/* 1 */
		$record = new Record();
		$record->title = 'Revelatia';
		$record->save();

		$artistsId = [
			Artist::where('name', 'Cristi Cons')->first()->id,
			Artist::where('name', 'Suolo')->first()->id,
		];
		$record->artists()->attach($artistsId);
		$record->label_id = Label::where('name', 'BodyParts')->first()->id;
		$record->save();

		/* 2 */
		$record = new Record();
		$record->title = 'Goneta';
		$record->save();

		$artist = Artist::where('name', 'Mihai Pol')->first();
		$record->artists()->attach($artist->id);
		$record->label_id = Label::where('name', 'Capodopere')->first()->id;
		$record->save();

		/* 3 */
		$record = new Record();
		$record->title = 'Mulen';
		$record->save();

		$artist = Artist::where('name', 'Suolo')->first();
		$record->artists()->attach($artist->id);
		$record->label_id = Label::where('name', 'Capodopere')->first()->id;
		$record->save();

	}
}
