<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCourseMapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course_map', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('course_id')->unsigned();
            $table->integer('semester');
            $table->integer('academic_year')->unsigned();
            $table->string('branch');
            $table->foreign('user_id')->references('id')->on('user');
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
        Schema::dropIfExists('user_course_map');
    }
}
