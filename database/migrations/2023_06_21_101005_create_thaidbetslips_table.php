<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThaidbetslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thaidbetslips', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->bigInteger('reward')->default(null)->nullable(true);
            $table->string('slip_number')->default(null)->nullable(true);
            $table->date('draw_date')->default(null)->nullable(true);
            $table->string('status')->nullable(true)->default('active');
            $table->string('bet_date')->default(Carbon::now())->nullable(true);
            $table->integer('is_reject')->default(0)->nullable(true);
            $table->integer('thaidsection_id');
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
        Schema::dropIfExists('thaidbetslips');
    }
}
