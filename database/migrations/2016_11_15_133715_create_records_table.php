<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('records', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->date('release_date')->nullable();
			$table->integer('label_id')->nullable()->unsigned();
			$table->string('catalog')->nullable();
			$table->string('format')->nullable();
			$table->text('description')->nullable();
			$table->string('image')->nullable();
			$table->string('price')->nullable();
			$table->integer('stock')->nullable();
			$table->boolean('online')->nullable()->default(false);
			$table->timestamps();
			$table->softDeletes();

			$table->foreign('label_id')
				->references('id')
				->on('labels');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('records');
	}
}
