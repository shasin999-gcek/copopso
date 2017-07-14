<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToWeightagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('weightages', function(Blueprint $table)
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
		Schema::table('weightages', function(Blueprint $table)
		{
			$table->dropForeign('weightages_user_course_id_foreign');
		});
	}

}
