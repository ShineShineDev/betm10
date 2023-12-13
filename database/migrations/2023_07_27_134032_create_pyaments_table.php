<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePyamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pyaments', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default("on")->nullable(true);
            $table->string('payment_type')->default("kpay")->nullable(true);
            $table->string('payment_name');
            $table->string('avatar')->nullable(true)->default(null);
            $table->bigInteger('payment_phone');
            $table->bigInteger('rate')->nullable(true)->default(null);
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
        Schema::dropIfExists('pyaments');
    }
}
