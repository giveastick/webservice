<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Doctrine\DBAL\Driver\PDOMySql\Driver;

class UpdateColumns extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sticklines', function(Blueprint $table)
		{
			$table->renameColumn('reseted', 'reseted_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sticklines', function(Blueprint $table)
		{
			$table->renameColumn('reseted_at', 'reseted');
		});
	}

}
