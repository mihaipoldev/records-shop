<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tracks', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->integer('record_id')->nullable()->unsigned();
			$table->string('side')->nullable();
			$table->string('audio')->nullable();
			$table->string('wave')->nullable();
			$table->string('length')->nullable();
			$table->string('bpm')->nullable();
			$table->boolean('draft')->nullable()->default(false);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('record_id')
				->references('id')
				->on('records');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tracks');
	}
}
