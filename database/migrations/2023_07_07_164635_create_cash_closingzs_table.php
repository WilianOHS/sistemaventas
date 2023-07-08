<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashClosingzsTable extends Migration
{
    public function up()
    {
        Schema::create('cash_closingzs', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('user_id');
            $table->dateTime('closings_date');
            $table->string('closings_hour');
            $table->integer('start_ticket');
            $table->integer('end_ticket');
            $table->integer('start_invoice');
            $table->integer('end_invoice');
            $table->integer('start_tax_credit');
            $table->integer('end_tax_credit');
            $table->decimal('total_sale_ticket', 10, 2);
            $table->decimal('total_sale_invoice', 10, 2);
            $table->decimal('total_sale_tax_credit', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_closingzs');
    }
}
