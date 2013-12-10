<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAnonymousToThreads extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('threads', function(Blueprint $table)
		{
			$table->boolean( 'anonymous' )->default( false );
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('threads', function(Blueprint $table)
		{
			$table->dropColumn( 'anonymous' );
		});
	}

}