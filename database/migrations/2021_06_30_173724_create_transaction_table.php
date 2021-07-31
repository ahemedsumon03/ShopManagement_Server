<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('invoice_no',200);
           $table->string('invoice_date',200);
           $table->string('product_name',200);
           $table->string('product_quantity',200);
           $table->string('unit_price',200);
           $table->string('total_price',200);
           $table->string('seller_name',200);
        });
    }


    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
