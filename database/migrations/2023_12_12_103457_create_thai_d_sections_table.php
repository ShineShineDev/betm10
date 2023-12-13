<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThaiDSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thai_d_sections', function (Blueprint $table) {
            $table->id();
            $table->string("opening_date");
            $table->string("opening_time");
            $table->string("closing_time");
            $table->bigInteger("to_bet_amount");
            $table->integer("user_commission");
            $table->integer("agent_commission");
            $table->integer("is_maintenace")->default(0)->comment("0 = not maintenace , 1 maintenace");
            $table->string("status")->default(1)->comment("1 = Opening , 0 = Closed");
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
        Schema::dropIfExists('thai_d_sections');
    }
}









