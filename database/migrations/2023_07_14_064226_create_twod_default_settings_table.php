<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodDefaultSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_default_settings', function (Blueprint $table) {
            $table->id();
            $table->string('opening_time')->nullable();
            $table->string('closing_time')->nullable();
            $table->string('odd')->nullable();
            $table->integer('min_amount')->nullable();
            $table->integer('max_amount')->nullable();
            $table->integer('user_commission')->nullable();
            $table->integer('agent_commission')->nullable();
            $table->string('block_numbers')->nullable();
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
        Schema::dropIfExists('twod_default_settings');
    }
}
