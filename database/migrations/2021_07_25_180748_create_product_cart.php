<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_cart', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_name',200);
            $table->string('product_code',200);
            $table->string('product_icon',200);
            $table->string('quantity',100);
            $table->string('product_unit_price',200);
            $table->string('product_total_price',200);
            $table->string('product_category',200);
            $table->string('seller_name',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_cart');
    }
}
