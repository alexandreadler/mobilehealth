<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendations extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		// Creates the users table
		Schema::connection('public')->create('recommendation', function (Blueprint  $table) {
			$table->increments('id');
			$table->integer('id_person')->nullable();
			$table->integer('id_content')->nullable();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::connection('public')->drop('recommendation');
	}

}
