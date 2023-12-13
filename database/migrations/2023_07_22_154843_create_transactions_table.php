<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer("customer_id");
            $table->string("transaction_id");
            $table->string("type");
            $table->bigInteger("amount");
            $table->string("transaction_model")->nullable(true)->default(null);
            $table->string("transaction_type")->nullable(true)->default(null);
            $table->integer("payer_account_phone");
            $table->string("payer_account_name");
            $table->integer("payment_transaction_id")->nullable(true)->default(null);
            $table->bigInteger("receiver_account_phone")->nullable(true)->default(null);
            $table->string("receiver_account_name")->nullable(true)->default(null);
            $table->integer("payment_id");
            $table->date("duration")->nullable(true)->default(null);
            $table->longText("note")->nullable(true)->default(null);
            $table->string("status")->nullable(true)->default("Pending");
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
        Schema::dropIfExists('transactions');
    }
}
