<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(ArtistTableSeeder::class);
	    $this->call(LabelTableSeeder::class);
	    $this->call(RecordTableSeeder::class);
	    $this->call(TrackTableSeeder::class);
    }
}