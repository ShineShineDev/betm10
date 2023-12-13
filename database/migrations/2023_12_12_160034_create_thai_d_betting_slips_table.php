<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThaiDBettingSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thai_d_betting_slips', function (Blueprint $table) {
            $table->id();
            $table->string("slip_number");
            $table->string("customer_id");
            $table->bigInteger("total_amount");
            $table->string("thai_section_id");
            $table->string("bet_date");
            $table->string("is_reject")->default(0);
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
        Schema::dropIfExists('thai_d_betting_slips');
    }
}







