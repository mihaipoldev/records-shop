<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordArtist extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_artist', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('record_id')->unsigned();
			$table->integer('artist_id')->unsigned();
			$table->integer('order')->nullable();
			$table->boolean('remix')->nullable()->default(false);
			$table->timestamps();

			$table->foreign('record_id')
				->references('id')
				->on('records');
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
		Schema::drop('record_artist');
	}
}
