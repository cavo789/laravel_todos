<button type="submit" class="btn btn-sm btn-success" 
	onclick="location.href='{{ route('todos.show', ['id' => $data->id]) }}'">
	<i class="far fa-eye"></i> Show
</button>
