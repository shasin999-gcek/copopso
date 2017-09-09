<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPoJustificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('po_justifications', function(Blueprint $table)
		{
			$table->foreign('co_id')->references('id')->on('cos')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('po_id')->references('id')->on('pos')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('po_justifications', function(Blueprint $table)
		{
			$table->dropForeign('po_justifications_co_id_foreign');
			$table->dropForeign('po_justifications_po_id_foreign');
		});
	}

}
