<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
	/**
	 * The migration is running
	 * Define a foreign key between user_id and the users table
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('todos', function (Blueprint $table) {
			// Our primary key
			$table->increments('id');

			// Allow Eloquent to add two fields and managed them:
			// created_at and updated_at
			$table->timestamps();

			$table->string('title', 100);
			$table->boolean('completed')->default(0);
			$table->text('description', 1000)->nullable();

			// The author of the record
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('todos');
	}
}
