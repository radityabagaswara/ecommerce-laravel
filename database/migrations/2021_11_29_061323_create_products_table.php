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
            $table->charset = 'utf8mb4';
            $table->id();
            $table->string('name', 125)->nullable(false);
            $table->string('description', 1920)->nullable(false);
            $table->text('image');
            $table->integer('price', 0)->nullable(false);
            $table->string('model');
            $table->string('ram');
            $table->string('battery_capacity');
            $table->string('cpu');
            $table->string('screen_size');
            $table->string('hard_disk');
            $table->string('hard_disk_capacity');
            $table->string('graphic_card');
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
