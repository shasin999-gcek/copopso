<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCotestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cotest', function(Blueprint $table)
		{
			$table->integer('co_id', true);
			$table->text('co1', 65535);
			$table->text('co2', 65535);
			$table->text('co3', 65535);
			$table->text('co4', 65535);
			$table->text('co5', 65535);
			$table->text('co6', 65535);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cotest');
	}

}
