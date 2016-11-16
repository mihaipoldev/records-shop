<?php

use Illuminate\Database\Seeder;

class TrackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('tracks')->delete();

	    $track = new \App\Models\Track();
	    $track->title = 'Goneta';
	    $record = \App\Models\Record::where('title', '=' ,'Goneta')->first();
	    $record->tracks()->save($track);
    }
}
