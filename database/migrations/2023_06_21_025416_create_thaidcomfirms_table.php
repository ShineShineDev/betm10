<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThaidcomfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thaidcomfirms', function (Blueprint $table) {
            $table->id();
            $table->string('bet_number');
            $table->integer('price')->default(7000)->nullable(true);
            $table->integer('thaibetslip_id')->nullable(true)->default(null);
            $table->bigInteger('reward')->nullable(true)->default(0);
            $table->integer('thaidprice')->nullable(true)->default(null);
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
        Schema::dropIfExists('thaidcomfirms');
    }
}
