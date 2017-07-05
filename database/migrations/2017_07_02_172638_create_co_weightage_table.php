<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoWeightageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('co_weightage', function (Blueprint $table) {
            //
            $table->integer ( 'co_id' );
            $table->float ( 't1' );
            $table->float ( 't2' );
            $table->float ( 'a1' );
            $table->float ( 'a2' );
            $table->float ( 'i' );
            $table->float ( 'u' );
            $table->float ( 'attendance' );
            $table->foreign('co_id')->references('id')->on('cos')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('co_weightage'); 
    }
}
