<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('banner')->nullable();
            $table->string('metting_point')->nullable();
            $table->integer('city_id')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->longText('desc')->nullable();
            $table->string('detail_banner')->nullable();
            $table->longText('detail_section_one_desc_one')->nullable();
            $table->longText('detail_section_one_desc_two')->nullable();
            $table->string('detail_section_two_banner')->nullable();
            $table->longText('detail_section_two_desc_one')->nullable();
            $table->longText('detail_section_two_desc_two')->nullable();
            $table->longText('detail_section_three_desc_one')->nullable();
            $table->longText('detail_section_three_desc_two')->nullable();
            $table->string('detail_section_four_banner')->nullable();
            $table->longText('detail_section_four_desc_one')->nullable();
            $table->longText('detail_section_four_desc_two')->nullable();
            $table->string('detail_section_five_banner')->nullable();
            $table->string('detail_face_book_url')->nullable();
            $table->string('detail_twitter_url')->nullable();
            $table->string('detail_google_plus_url')->nullable();
            $table->string('detail_whatsapp_url')->nullable();
            $table->string('detail_plus_url')->nullable();
            $table->longText('detail_who_can_attend')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('schedule');
    }
}
