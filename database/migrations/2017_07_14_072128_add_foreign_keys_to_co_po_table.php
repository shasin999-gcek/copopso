<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCoPoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('co_po', function(Blueprint $table)
		{
			$table->foreign('co_id', 'co_po_cos_id_foreign')->references('id')->on('cos')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('co_po', function(Blueprint $table)
		{
			$table->dropForeign('co_po_cos_id_foreign');
		});
	}

}
