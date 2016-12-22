<?php

use Illuminate\Database\Seeder;

class ArtistRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('artist_record')->delete();

	    $artist_records = [];
	    $artist_records[0] = [];
	    $artist_records[0]['artist_id'] = 1, 35
	    $artist_records[0]['artist_id'] = 2, 36
	    $artist_records[0]['artist_id'] = 3, 35
	    $artist_records[0]['artist_id'] = 3, 37
	    DB::statement('INSERT INTO artist_record ');
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
