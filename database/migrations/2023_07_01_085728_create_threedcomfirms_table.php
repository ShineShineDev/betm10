<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreedcomfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threedcomfirms', function (Blueprint $table) {
            $table->id();
            $table->string('bet_number');
            $table->integer('price')->default(7000)->nullable(true);
            $table->integer('threedbetslip_id')->nullable(true)->default(null);
            $table->bigInteger('reward')->nullable(true)->default(0);
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
        Schema::dropIfExists('threedcomfirms');
    }
}
