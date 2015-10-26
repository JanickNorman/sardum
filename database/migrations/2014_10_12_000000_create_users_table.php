<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->enum('provider', ['fb', 'tw']);
	        $table->string('provider_id');
	      	$table->string('nama');
	        $table->string('email');
	        $table->string('nomer_handphone');
	        $table->string('alamat');
	        $table->string('tanggal_lahir');
		   	$table->rememberToken();
		   	$table->timestamps();

		   	$table->unique(['provider', 'provider_id']);
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
