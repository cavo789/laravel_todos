<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Repositories\TodoRepositoryInterface;
use App\Repositories\TodoRepository;
use Response;

class TodoController extends Controller
{
	protected $todoRepository;

	protected $nbrPerPage = 5;

	public function __construct(TodoRepositoryInterface $todoRepository)
	{
		$this->todoRepository = $todoRepository;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		// Retrieve all todos
		$datas = $this->todoRepository->getPaginate($this->nbrPerPage);
		$links = $datas->render();

		// call the index.blade.php view and pass the data
		return view('index', compact('datas', 'links'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(TodoRequest $request)
	{
		$todo = $this->todoRepository->store($request->all());

		return redirect()->route('todos.show', ['id' => $todo->id])->withOk('Todo has been successfully created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int                       $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(int $id)
	{
		$data = $this->todoRepository->getById($id);

		return view('show', compact('data'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int                       $id
	 * @param  TodoRepositoryInterface   $todoRepository
	 * @return \Illuminate\Http\Response
	 */
	public function edit(int $id)
	{
		$data = $this->todoRepository->getById($id);

		return view('edit', compact('data'));
	}

	/**
	 * Update the specified resource in storage.
	 * This function answer to the PUT method (updating an existing record)
	 *
	 * @param  TodoRequest               $request
	 * @param  int                       $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(TodoRequest $request, int $id)
	{
		$this->todoRepository->update($id, $request->all());

		// Redirect to the edit form
		return redirect()->route('todos.edit', ['id' => $id])->withOk('Successfully updated');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int                       $id
	 * @param  TodoRepositoryInterface   $todoRepository
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $request, int $id)
	{
		$this->todoRepository->destroy($id);

		if (!$request->ajax()) {
			return redirect()->route('todos.index')->withOk('Successfully removed');
		} else {
			// Return a JSON string that will be used in an Ajax request
			return Response::json([
				'status' => true,
				'message' => 'Successfully deleted'
			]);
		}
	}
}
