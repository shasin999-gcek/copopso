<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->integer('user_course_id');
            $table->boolean('co')->default(0);
            $table->boolean('copopso')->default(0);
            $table->boolean('po1')->default(0);
            $table->boolean('po2')->default(0);
            $table->boolean('po3')->default(0);
            $table->boolean('po4')->default(0);
            $table->boolean('po5')->default(0);
            $table->boolean('po6')->default(0);
            $table->boolean('po7')->default(0);
            $table->boolean('po8')->default(0);
            $table->boolean('po9')->default(0);
            $table->boolean('po10')->default(0);
            $table->boolean('po11')->default(0);
            $table->boolean('po12')->default(0);
            $table->boolean('pso1')->default(0);
            $table->boolean('pso2')->default(0);
            $table->boolean('pso3')->default(0);
            $table->boolean('pso4')->default(0);
            $table->boolean('weightage')->default(0);
            $table->boolean('upload')->default(0);
            
            $table->foreign('user_course_id')->references('id')->on('user_course')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
}
