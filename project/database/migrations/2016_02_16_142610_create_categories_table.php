<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_category');
            $table->text('icon');
            $table->timestamps();
        });

        \App\Category::create(['name_category'=>'Moteur']);
        \App\Category::create(['name_category'=>'Cylindree']);
        \App\Category::create(['name_category'=>'Energie']);
        \App\Category::create(['name_category'=>'Transmission']);
        \App\Category::create(['name_category'=>'Puissance fiscale']);
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }
}
