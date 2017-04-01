<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UploadCsvTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create ( 'uploads', function ($table) {
            $table->integer ( 'rollno' );
            $table->string ( 'name' );
            $table->float ( 't1' );
            $table->float ( 't2' );
            $table->float ( 'a1' );
            $table->float ( 'a2' );
            $table->float ( 'i' );
            $table->float ( 'u' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('uploads'); //
    }
}