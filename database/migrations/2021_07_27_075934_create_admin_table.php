<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{

    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->string('name',200);
           $table->string('email',200);
           $table->string('password',200);
           $table->string('create_time',200);
           $table->string('create_date',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
