<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashOpeningsTable extends Migration
{
    public function up()
    {
        Schema::create('cash_openings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->decimal('opening_balance', 10, 2);
            $table->decimal('income', 10, 2);
            $table->decimal('voucher', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cash_openings');
    }
}

