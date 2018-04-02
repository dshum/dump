<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEatenFoodstuffs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eaten_foodstuffs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('foodstuff_id')->unsigned()->index();
            $table->integer('grams');
            $table->integer('service_section_id')->unsigned()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eaten_foodstuffs');
    }
}
