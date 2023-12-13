<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->bigInteger('customer_amount')->nullable(true)->default(null);
            $table->bigInteger('customer_phone')->nullable(true)->default(null);
            $table->string('customer_name')->nullable(true)->default(null);
            $table->integer('payment_id');
            $table->string('transaction_number')->nullable(true)->default(null);
            $table->string('type')->nullable(true)->default(null);
            $table->date('date')->nullable(true)->default(null);
            $table->string('status')->nullable(true)->default('pending');
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
        Schema::dropIfExists('payment_transactions');
    }
}
