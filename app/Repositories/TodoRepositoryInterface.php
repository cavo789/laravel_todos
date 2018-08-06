<?php

namespace App\Repositories;

use App\Todo;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Requests\TodoRequest;

/**
 * Define the function that should be available through the
 * TodoRepository
 */
interface TodoRepositoryInterface
{
	/**
	 * Get a pagination
	 *
	 * @param  int        $n
	 * @return Collection
	 */
	public function getPaginate(int $n);

	/**
	 * Get the list of records of the table
	 *
	 * @return Collection
	 */
	public function index() : Collection;

	/**
	 * Get a specific todo; identified by his ID
	 *
	 * @param  int  $id
	 * @return Todo
	 */
	public function getById(int $id) : Todo;

	/**
	 * Save the todo
	 *
	 * @param  array $inputs Submitted datas
	 * @return void
	 */
	//public function store(TodoRequest $todo) : Todo;
	public function store(array $inputs) : Todo;

	/**
	 * Remove the specified todo
	 *
	 * @param  int  $id
	 * @return void
	 */
	public function destroy(int $id);

	/**
	 * Update the specified todo, update columns
	 *
	 * @param  int   $id
	 * @param  array $inputs Submitted datas
	 * @return void
	 */
	public function update(int $id, array $inputs) : Todo;
}
