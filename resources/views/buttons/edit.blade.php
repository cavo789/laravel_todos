<button type="submit" class="btn btn-sm btn-primary" 
	onclick="location.href='{{ route('todos.edit', ['id' => $data->id]) }}'">
	<i class="far fa-edit"></i> Edit
</button>
