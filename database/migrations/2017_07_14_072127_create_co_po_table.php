<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoPoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('co_po', function(Blueprint $table)
		{
			$table->integer('co_id');
			$table->integer('po1');
			$table->integer('po2');
			$table->integer('po3');
			$table->integer('po4');
			$table->integer('po5');
			$table->integer('po6');
			$table->integer('po7');
			$table->integer('po8');
			$table->integer('po9');
			$table->integer('po10');
			$table->integer('po11');
			$table->integer('po12');
			$table->integer('pso1');
			$table->integer('pso2');
			$table->integer('pso3');
			$table->integer('pso4');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('co_po');
	}

}
