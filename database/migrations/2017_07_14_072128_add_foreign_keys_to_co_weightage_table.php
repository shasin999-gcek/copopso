<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCoWeightageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('co_weightage', function(Blueprint $table)
		{
			$table->foreign('co_id')->references('id')->on('cos')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('co_weightage', function(Blueprint $table)
		{
			$table->dropForeign('co_weightage_co_id_foreign');
		});
	}

}
