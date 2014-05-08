<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSticklinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sticklines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('channelTag');
			$table->string('nickname');
			$table->tinyInteger('credit');
			$table->dateTime('reseted_at')->nullable();
			$table->string('giver')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sticklines');
	}

}
