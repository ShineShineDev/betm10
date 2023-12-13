<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwodSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twod_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('twod_type_id')->nullable();
            $table->integer('twod_type_name')->nullable();
            $table->string('opening_datetime')->nullable();
            $table->string('closing_datetime')->nullable();
            $table->string('odd')->nullable();
            $table->integer('min_amount')->nullable();
            $table->integer('max_amount')->nullable();
            $table->integer('user_commission')->nullable();
            $table->integer('agent_commission')->nullable();
            $table->string('set')->nullable();
            $table->string('value')->nullable();
            $table->string('winning_number')->nullable();
            $table->string('reward_users')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('twod_sections');
    }
}
