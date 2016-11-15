<?php

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

	    $record = new \App\Models\Record([
		    'title' => 'Revelatia',
	    ]);
	    $record->save();

	    $artist = \App\Models\Artist::where('name', '=' ,'Cristi Cons')->first();
	    $record->artists()->attach($artist->id);

	    $label = \App\Models\Label::where('name', '=' ,'BodyParts')->first();
	    $label->records()->save($record);

	    $record->save();

    }
}
