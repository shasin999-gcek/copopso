<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cos', function(Blueprint $table)
		{
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
		Schema::table('cos', function(Blueprint $table)
		{
			$table->dropForeign('cos_user_course_id_foreign');
		});
	}

}
