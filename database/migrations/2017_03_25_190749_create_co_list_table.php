<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_list', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->integer('academic_year')->unsigned();
            $table->string('C01');
            $table->string('C02');
            $table->string('C03');
            $table->string('C04');
            $table->string('C05');
            $table->string('C06');
            $table->primary(array('course_id', 'academic_year'));
            $table->foreign('course_id')->references('id')->on('course');
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
