<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
	// Name of our table in the database
	protected $table = 'todos';

	// Only if $table->timestamps() was mentioned in the
	// CreateTodosTable class; set to False if not mentioned
	public $timestamps = true;

	// List of columns that we can update
	public $fillable = ['title', 'completed', 'description'];

	/**
	 * Extend the model and offer a convenient way to retrieve the
	 * user linked to our todo (thanks the user_id foreign key and
	 * his link with the users table)
	 *
	 * @return void
	 */
	public function user()
	{
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
