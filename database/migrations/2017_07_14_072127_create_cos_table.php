<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_course_id');
			$table->string('name');
			$table->string('description');
			//Uncomment following line after setting validation for composite primary key

			//$table->unique(['user_course_id', 'name']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cos');
	}

}
