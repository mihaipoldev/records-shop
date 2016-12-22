<?php

use App\Models\Record;
use App\Models\Track;
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

	    $record = Record::where('title', '=' ,'Goneta')->first();

	    $track = new Track();
	    $track->title = 'Goneta';
	    $track->audio_path = 'mihai-pol-goneta-preview.mp3';
	    $record->tracks()->save($track);

	    $track = new Track();
	    $track->title = 'Science Friction';
	    $track->audio_path = 'mihai-pol-science-friction-preview.mp3';
	    $record->tracks()->save($track);
    }
}
