<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodBetLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_bet_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('twod_bet_slip_id')->nullable();
            $table->string('slip_number')->nullable();
            $table->integer('reward_amount')->nullable( );
            $table->string('draw_date')->nullable();
            $table->string('bet_number')->nullable();
            $table->integer('bet_amount')->nullable();
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
        Schema::dropIfExists('twod_bet_logs');
    }
}
