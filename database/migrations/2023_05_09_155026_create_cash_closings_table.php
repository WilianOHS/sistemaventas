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
            $table->integer('user_id');
            $table->integer('cashopening_id');
            $table->dateTime('closings_date');
            $table->string('closings_hour');
            $table->decimal('cash', 8, 2);
            $table->integer('start_ticket');
            $table->integer('end_ticket');
            $table->integer('start_invoice');
            $table->integer('end_invoice');
            $table->integer('start_tax_credit');
            $table->integer('end_tax_credit');
            $table->decimal('initial_balance', 10, 2);
            $table->decimal('daily_sales', 10, 2);
            $table->decimal('income', 10, 2);
            $table->decimal('vouchers', 10, 2);
            $table->decimal('cash_sales', 10, 2);
            $table->decimal('card_sales', 10, 2);
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
