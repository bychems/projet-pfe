<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestDriveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           Schema::create('test_drive', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date_begin');
            $table->dateTime('date_end');
            $table->text('state');
            $table->integer('id_customer')->unsigned();
            $table->foreign('id_customer')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_car')->unsigned();
            $table->foreign('id_car')->references('id')->on('cars')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('test_drive');
    }
}
