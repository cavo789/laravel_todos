<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Repositories\TodoRepositoryInterface;
use Response;

class TodoController extends Controller
{
	/**
	 * Show the list of todos
	 *
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function index(
		TodoRepositoryInterface $todoRepository
	) {
		// Retrieve all todos
		$datas = $todoRepository->index();

		// call the list.blade.php view and pass the data
		return view('list', compact('datas'));
	}

	/**
	 * Show the detail of a todo
	 *
	 * @param  integer                 $id
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function show(int $id, TodoRepositoryInterface $todoRepository)
	{
		$data = $todoRepository->get($id);

		return view('show', compact('data'));
	}

	/**
	 * Show the submission form
	 *
	 * @return void
	 */
	public function getForm()
	{
		return view('form');
	}

	/**
	 * The form is being submitted, save the data, create a new todo
	 * This function answer to the POST method, not PUT
	 *
	 * @param  TodoRequest             $request
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function postForm(
		TodoRequest $request,
		TodoRepositoryInterface $todoRepository
	) {
		$todoRepository->save($request);

		// Show the form back and pass a "Success" alert
		return redirect()->back()
			->with('message', '<div class="alert alert-success" role="alert">' .
				'Successfully created</div>');
	}

	/**
	 * Edit an existing record : retrieve the record and show the form
	 *
	 * @param  integer                 $id
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function edit(int $id, TodoRepositoryInterface $todoRepository)
	{
		$data = $todoRepository->get($id);

		return view('form', compact('data'));
	}

	/**
	 * Delete a todo
	 *
	 * @param  integer                 $id
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function delete(int $id, TodoRepositoryInterface $todoRepository)
	{
		$todoRepository->delete($id);

		// Return a JSON string that will be used in an Ajax request
		return Response::json([
			'status' => true,
			'message' => '<div class="alert alert-success" role="alert">' .
				'Successfully deleted</div>'
		]);
	}

	/**
	 * Update a todo record
	 * This function answer to the PUT method (updating an existing record)
	 *
	 * @param  TodoRequest             $request
	 * @param  TodoRepositoryInterface $todoRepository
	 * @return void
	 */
	public function put(TodoRequest $request, TodoRepositoryInterface $todoRepository)
	{
		$todoRepository->put($request);

		// Redirect to the edit form
		return redirect()->back()
			->with('message', '<div class="alert alert-success" role="alert">' .
				'Successfully updated</div>');
	}
}
