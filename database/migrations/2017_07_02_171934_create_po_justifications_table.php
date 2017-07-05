<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoJustificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po_justifications', function (Blueprint $table) {
            //
            $table->integer('co_id');
            $table->integer('po_id');
            $table->string('justifications');
            
            $table->foreign('co_id')->references('id')->on('cos')->onDelete('cascade');
            $table->foreign('po_id')->references('id')->on('pos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('po_justifications');
    }
}
