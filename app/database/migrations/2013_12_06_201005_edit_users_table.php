<?php

use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table) {
			$table->string('password')->nullable();
			$table->string('token')->unique();
			$table->enum('role', array('sender', 'recipient', 'admin'))->default('admin');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
			$table->dropColumn(array( 'password', 'token', 'role' ));
		});
	}

}