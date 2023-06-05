<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomePageContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_page_content', function (Blueprint $table) {
            $table->id();
            $table->string('banner')->nullable();
            $table->longText('section_one_banner_desc_one')->nullable();
            $table->longText('section_one_banner_desc_two')->nullable();
            $table->string('section_two_title')->nullable();
            $table->string('section_two_banner')->nullable();
            $table->longText('section_two_banner_desc_one')->nullable();
            $table->longText('section_two_banner_desc_two')->nullable();
            $table->string('section_three_title')->nullable();
            $table->string('section_three_banner')->nullable();
            $table->longText('section_three_desc_one')->nullable();
            $table->longText('section_three_desc_two')->nullable();
            $table->string('section_four_title')->nullable();
            $table->string('section_four_banner')->nullable();
            $table->longText('section_four_desc_one')->nullable();
            $table->longText('section_four_desc_two')->nullable();
            $table->string('section_five_contest_title')->nullable();
            $table->string('section_five_contest_sub_title')->nullable();
            $table->string('section_five_contest_desc')->nullable();
            $table->string('section_five_contest_winning_text')->nullable();
            $table->string('section_five_contest_end_text')->nullable();
            $table->string('section_five_contest_image')->nullable();
            $table->longText('section_six_community_desc_one')->nullable();
            $table->longText('section_six_community_desc_two')->nullable();
            $table->string('section_seven_banner')->nullable();
            $table->string('section_eight_banner')->nullable();
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
        Schema::dropIfExists('home_page_content');
    }
}
