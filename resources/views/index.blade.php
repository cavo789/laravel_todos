@extends('master')

@section('content')

	@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
  @endif
    
  {{--
    $data is a collection of records
  --}}
  @isset($datas)
    {{--
      For each todo, we'll show his title in a H3
      Clicking on the title will display the todo's details
      We'll also show: todo's description and his author.
    --}}
    @foreach($datas as $data)
      <h3><a href="{{ route('todos.show', ['id' => $data->id]) }}">#{{ $loop->iteration. " - " . $data->title }}</a></h3>

      <div style="padding:5px 0 15px 0;">
        <button type="submit" class="btn btn-sm btn-success" 
          onclick="location.href='{{ route('todos.show', ['id' => $data->id]) }}'">
          <i class="glyphicon glyphicon-eye-open"></i> Show
        </button>

        <button type="submit" class="btn btn-sm btn-primary" 
          onclick="location.href='{{ route('todos.edit', ['id' => $data->id]) }}'">
          <i class="glyphicon glyphicon-edit"></i> Edit
        </button>

        {!! Form::open(['method' => 'DELETE', 'route' => ['todos.destroy', $data->id], 'style' => 'display:inline']) !!}
        
        <button type="submit" class="btn btn-sm btn-danger delete" onclick="return confirm('Remove this record?')">
          <i class="glyphicon glyphicon-remove"></i> Delete
        </button>

        {!! Form::close() !!}
      </div>
      <p>{{ $data->description }}</p>
      <small>Author: {{ $data->user->name }}</small>
      <hr/>
    @endforeach
    <small>Number of todos: {{ count($datas) }}</small>
  @endisset
@endsection

@section('navigation')
  {{ $links }}
  <hr/>
  <button type="submit" class="btn btn-sm btn-primary" 
    onclick="location.href='{{ route('todos.create') }}'">
    <i class="glyphicon glyphicon-plus"></i> Add new item
  </button>
@endsection
