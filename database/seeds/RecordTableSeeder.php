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

	    //  1
	    $record = new \App\Models\Record([
		    'title' => 'Revelatia',
	    ]);
	    $record->save();

	    $artistsId = [
	    	\App\Models\Artist::where('name', '=' ,'Cristi Cons')->first()->id,
		    \App\Models\Artist::where('name', '=' ,'Suolo')->first()->id
	    ];
	    $record->artists()->attach($artistsId);

	    $label = \App\Models\Label::where('name', '=' ,'BodyParts')->first();
	    $label->records()->save($record);

	    $record->save();

	    //  2
	    $record = new \App\Models\Record([
		    'title' => 'Goneta',
	    ]);
	    $record->save();

	    $artist = \App\Models\Artist::where('name', '=' ,'Mihai Pol')->first();
	    $record->artists()->attach($artist->id);

	    $label = \App\Models\Label::where('name', '=' ,'Capodopere')->first();
	    $label->records()->save($record);

	    $record->save();

	    //  3
	    $record = new \App\Models\Record([
		    'title' => 'Mulen',
	    ]);
	    $record->save();

	    $artist = \App\Models\Artist::where('name', '=' ,'Suolo')->first();
	    $record->artists()->attach($artist->id);

	    $label = \App\Models\Label::where('name', '=' ,'Capodopere')->first();
	    $label->records()->save($record);

	    $record->save();

    }
}
