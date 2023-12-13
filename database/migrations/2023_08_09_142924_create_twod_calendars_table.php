<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_calendars', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('morning_modern');
            $table->integer('morning_internet');
            $table->integer('morning_number');
            $table->integer('evening_modern');
            $table->integer('evening_internet');
            $table->integer('evening_number');
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
        Schema::dropIfExists('twod_calendars');
    }
}
