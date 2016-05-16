<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->text('finition');
            $table->text('icon_finition');
            $table->text('consommation');
            $table->text('picture');
            $table->text('video');
            $table->float('basic_price');
            $table->boolean('test_drive');
             $table->integer('modele_id')->unsigned();
             $table->foreign('modele_id')->references('id')->on('modeles')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::drop('cars');
    }
}
