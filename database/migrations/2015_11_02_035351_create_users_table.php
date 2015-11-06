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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('provider_type', ['tw', 'fb']);
            $table->string('provider_id', 60);
            $table->string('nama', 100);
            $table->string('avatar')->nullable();
            $table->string('email', 100);
            $table->date('tanggal_lahir');
            $table->string('alamat', 60);
            $table->string('nomer_handphone', 20);
            $table->rememberToken();
            $table->timestamps();

            $table->unique(['provider_type', 'provider_id']);
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