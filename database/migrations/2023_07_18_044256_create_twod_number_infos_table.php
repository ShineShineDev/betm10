<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodNumberInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_number_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('twod_section_id');
            $table->string('number');
            $table->integer('min_amount')->nullable();
            $table->integer('max_amount')->nullable();
            $table->integer('is_blocked')->default(0)->nullable();
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
        Schema::dropIfExists('twod_number_infos');
    }
}
