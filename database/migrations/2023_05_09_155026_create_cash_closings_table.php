<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashClosingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_closings', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->dateTime('closings_date');
            $table->integer('tickets');
            $table->integer('invoices');
            $table->integer('tax_credits');
            $table->decimal('initial_balance', 8, 2);
            $table->decimal('income', 8, 2);
            $table->integer('vouchers');
            $table->decimal('cash_payments', 8, 2);
            $table->decimal('card_payments', 8, 2);
            $table->decimal('cash', 8, 2);
            $table->decimal('difference', 8, 2);
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
        Schema::dropIfExists('cash_closings');
    }
}
