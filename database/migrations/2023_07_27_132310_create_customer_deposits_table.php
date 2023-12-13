<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->bigInteger('customer_amount')->nullable(true)->default(null);
            $table->bigInteger('customer_phone')->nullable(true)->default(null);
            $table->string('customer_name')->nullable(true)->default(null);
            $table->integer('payment_id');
            $table->string('transaction_number')->nullable(true)->default(null);
            $table->date('transaction_date')->nullable(true)->default(Carbon::now());
            $table->string('status')->nullable(true)->default('deposit');
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
        Schema::dropIfExists('customer_deposits');
    }
}
