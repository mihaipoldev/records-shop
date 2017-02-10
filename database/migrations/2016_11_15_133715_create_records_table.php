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
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('label_id');
            $table->string('catalog');
            $table->string('price');
            $table->integer('quantity');
            $table->date('release_date');
            $table->date('is_online');
            $table->string('format');
            $table->string('image_path');
	        $table->timestamps();
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
