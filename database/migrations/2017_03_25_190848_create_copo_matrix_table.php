<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopoMatrixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copo_matrix', function (Blueprint $table) {
            $table->integer('course_id')->unsigned();
            $table->integer('academic_year')->unsigned();
            $table->integer('co');
            $table->integer('po1');
            $table->integer('po2');
            $table->integer('po3');
            $table->integer('po4');
            $table->integer('po5');
            $table->integer('po6');
            $table->integer('po7');
            $table->integer('po8');
            $table->integer('po9');
            $table->integer('po10');
            $table->integer('po11');
            $table->integer('po12');
            $table->integer('pso13');
            $table->integer('pso14');
            $table->integer('pso15');
            $table->primary(array('course_id', 'academic_year'));
        });

        Schema::table('copo_matrix', function (Blueprint $table) {
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
        Schema::dropIfExists('copo_matrix');
    }
}
