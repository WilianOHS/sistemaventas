<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('code')->unique()->nullable();
            $table->string('name')->unique();
            $table->integer('stock')->default(0);
            $table->string('image');
            $table->decimal('price',12,2);
            $table->decimal('sale_price',12,2);

            $table->string('presentation');
            $table->double('weight', 15, 8);
            $table->integer('year');
            $table->string('model');

            $table->enum('status',['ACTIVE','DEACTIVATED'])->default('ACTIVE');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('provider_id');
            $table->foreign('provider_id')->references('id')->on('providers');

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
        Schema::dropIfExists('products');
    }
}
