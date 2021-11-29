<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            //Categories
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')->references('id')->on('categories');

            //Brands
            $table->unsignedBigInteger('brands_id');
            $table->foreign('brands_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //Categories
            $table->dropForeign(['categories_id']);
            $table->dropColumn('categories_id');

            //Brands
            $table->dropForeign(['brands_id']);
            $table->dropColumn('brands_id');
        });
    }
}
