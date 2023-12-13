<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThreedbetslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threedbetslips', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->bigInteger('reward')->default(null)->nullable(true);
            $table->string('slip_number')->default(null)->nullable(true);
            $table->date('draw_date')->default(null)->nullable(true);
            $table->string('status')->nullable(true)->default(null);
            $table->string('bet_date')->default(Carbon::now())->nullable(true);
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
        Schema::dropIfExists('threedbetslips');
    }
}
