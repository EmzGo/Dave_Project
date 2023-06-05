<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('banner')->nullable();
            $table->string('section_one_community_title')->nullable();
            $table->longText('section_one_community_desc_one')->nullable();
            $table->longText('section_one_community_desc_two')->nullable();
            $table->string('section_two_image')->nullable();
            $table->string('section_three_travel_title')->nullable();
            $table->longText('section_three_travel_desc_one')->nullable();
            $table->longText('section_three_travel_desc_two')->nullable();
            $table->string('section_four_image')->nullable();
            $table->string('section_five_learn_title')->nullable();
            $table->longText('section_five_learn_desc_one')->nullable();
            $table->longText('section_five_learn_desc_two')->nullable();
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
        Schema::dropIfExists('about_us');
    }
}
