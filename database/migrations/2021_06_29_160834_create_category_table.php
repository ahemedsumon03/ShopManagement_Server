<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{

    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('cat_name',200);
           $table->string('cat_code',200);
           $table->string('cat_icon',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
