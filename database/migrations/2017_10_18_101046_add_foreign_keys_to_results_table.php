<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')
                  ->onUpdate('RESTRICT')->onDelete('CASCADE');

            $table->foreign('department_id')->references('id')->on('departments')
                 ->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign('results_course_id_foreign');
            $table->dropForeign('results_department_id_foreign');
        });
    }
}
