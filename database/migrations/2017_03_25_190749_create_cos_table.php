<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_course_id')->unsigned();
            $table->string('name');
            $table->string('description');
            $table->foreign('user_course_id')->references('id')->on('user_course')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('co_list');
    }
}
