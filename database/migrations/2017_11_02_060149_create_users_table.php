<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('first_name', 191);
			$table->string('last_name', 191);
			$table->string('email', 191)->unique();
			$table->string('password', 191)->nullable();
			$table->text('address', 65535)->nullable();
			$table->integer('country_id')->unsigned()->index();
			$table->integer('state_id')->unsigned()->index();
			$table->integer('city_id')->unsigned()->index();
			$table->string('zip_code', 191);
			$table->string('ssn', 191);
			$table->boolean('status')->default(1);
			$table->string('confirmation_code', 191)->nullable();
			$table->boolean('confirmed')->default(0);
			$table->boolean('is_term_accept')->default(0)->comment(' 0 = not accepted,1 = accepted');
			$table->string('remember_token', 100)->nullable();
			$table->integer('created_by')->unsigned();
			$table->integer('updated_by')->unsigned()->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
