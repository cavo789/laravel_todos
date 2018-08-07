{!! Form::open(['method' => 'DELETE', 'route' => ['todos.destroy', $data->id], 'style' => 'display:inline']) !!}

<button type="submit" class="btn btn-sm btn-danger delete" onclick="return confirm('Remove this record?')">
	<i class="far fa-trash-alt"></i> Delete
</button>

{!! Form::close() !!}
