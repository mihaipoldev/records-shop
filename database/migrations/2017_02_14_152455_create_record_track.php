<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTrack extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_track', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('record_id')->unsigned();
			$table->integer('track_id')->unsigned();
			$table->integer('order')->nullable()->default(0);
			$table->timestamps();

			$table->foreign('record_id')
				->references('id')
				->on('records');
			$table->foreign('track_id')
				->references('id')
				->on('tracks');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('record_track');
	}
}
