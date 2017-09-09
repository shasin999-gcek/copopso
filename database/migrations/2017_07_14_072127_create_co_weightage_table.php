<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoWeightageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('co_weightage', function(Blueprint $table)
		{
			$table->integer('co_id');
			$table->float('t1', 10, 0);
			$table->float('t2', 10, 0);
			$table->float('a1', 10, 0);
			$table->float('a2', 10, 0);
			$table->float('i', 10, 0);
			$table->float('u', 10, 0);
			$table->float('attendance', 10, 0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('co_weightage');
	}

}
