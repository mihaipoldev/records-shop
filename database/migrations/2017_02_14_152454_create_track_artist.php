<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackArtist extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('track_artist', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('track_id')->unsigned();
			$table->integer('artist_id')->unsigned();
			$table->boolean('remix')->nullable()->default(false);
			$table->integer('order')->nullable();
			$table->timestamps();

			$table->foreign('track_id')
				->references('id')
				->on('tracks');
			$table->foreign('artist_id')
				->references('id')
				->on('artists');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('track_artist');
	}
}
