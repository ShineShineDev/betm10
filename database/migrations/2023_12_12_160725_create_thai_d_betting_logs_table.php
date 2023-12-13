<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThaiDBettingLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thai_d_betting_logs', function (Blueprint $table) {
            $table->id();
            $table->string("thaid_section_id");
            $table->string("thaid_bet_slip_id");
            $table->string("slip_number");
            $table->string("bet_number");
            $table->string("reward_amount");
            $table->tinyInteger("rewrad_status")->default(0);
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
        Schema::dropIfExists('thai_d_betting_logs');
    }
}







