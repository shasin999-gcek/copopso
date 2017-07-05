<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weightages', function (Blueprint $table) {
            //
            $table->integer ( 'user_course_id' );
            $table->float ( 't1' );
            $table->float ( 't2' );
            $table->float ( 'a1' );
            $table->float ( 'a2' );
            $table->float ( 'i' );
            $table->float ( 'u' );
            $table->float ( 'attendance' );
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
        Schema::dropIfExists('weightages');
    }
}
