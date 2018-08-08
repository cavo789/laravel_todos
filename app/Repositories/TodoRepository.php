<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Todo;
use Auth;

/**
 * Implements functions for working with the todos table
 */
class TodoRepository implements TodoRepositoryInterface
{
	protected $todo;

	public function __construct(Todo $todo)
	{
		$this->todo = $todo;
	}

	public function getPaginate(int $n)
	{
		return $this->todo
			->latest('todos.created_at')
			->paginate($n);
	}

	/**
	 * Get the list of records of the table
	 *
	 * @return Collection
	 */
	public function index() : Collection
	{
		return $this->todo->all();
	}

	/**
	 * Get a specific todo; identified by his ID
	 *
	 * @param  int  $id
	 * @return Todo
	 */
	public function getById(int $id) : Todo
	{
		return $this->todo->where('id', $id)->firstOrFail();
	}

	private function save(Todo $todo, array $inputs) : Todo
	{
		$todo->title = $inputs['title'];
		$todo->description = $inputs['description'];

		$todo->save();

		return $todo;
	}

	/**
	 * Save the todo
	 *
	 * @param  array $inputs List of fields present in the creation form
	 * @return Todo
	 */
	public function store(array $inputs) : Todo
	{
		$todo = new $this->todo();

		$todo->completed = false;
		$todo->user_id = Auth::user()->id;

		return $this->save($todo, $inputs); // Save the submitted data
	}

	/**
	 * Remove the specified todo
	 *
	 * @param  int  $id
	 * @return void
	 */
	public function destroy(int $id)
	{
		$this->todo->destroy($id);
	}

	/**
	 * Update the specified todo, update columns
	 *
	 * @param  int   $id
	 * @param  array $inputs Submitted datas
	 * @return void
	 */
	public function update(int $id, array $inputs) : Todo
	{
		return $this->save($this->getById($id), $inputs);
	}
}
