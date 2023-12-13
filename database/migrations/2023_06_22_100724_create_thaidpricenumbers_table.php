<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThaidpricenumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thaidpricenumbers', function (Blueprint $table) {
            $table->id();
            $table->integer('thaidsection_id');
            $table->integer('thaidprice_id');
            $table->integer('winning_number');
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
        Schema::dropIfExists('thaidpricenumbers');
    }
}
