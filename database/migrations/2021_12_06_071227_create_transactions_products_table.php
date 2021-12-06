<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_products', function (Blueprint $table) {
            $table->id();
            $table->integer('qty');
            $table->float('discount');
            $table->integer('total');
            $table->integer('price');
            $table->unsignedBigInteger('products_id');
            $table->unsignedBigInteger('transactions_id');
            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('transactions_id')->references('id')->on('transactions');
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
        Schema::dropIfExists('transactions_products');
    }
}
