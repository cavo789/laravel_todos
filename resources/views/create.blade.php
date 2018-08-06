@extends('master')

@section('content')

  {{-- Display the name of the connected user --}}
  <div class="panel-heading">Hi {{ Auth::user()->name }}, please add your new Todo below</div>  

  <div class="panel-body">   

    {{-- 
      Messages sent by the controller like in
        return view('...')->with('message', '<div class="...">success</div>'))
      will be displayed here
    --}}
    @if(Session::has('message'))
      {!! Session::get('message') !!}
    @endif

    {!! Form::open(['route' => 'todos.store']) !!}

    <div class="form-group {!! $errors->has('todo') ? 'has-error' : '' !!}"> 
        {{--
          Output the "Title" entry.
        --}}
        {!! Form::text('title', '', array('size' => '100', 'class' => 'form-control', 'placeholder' => 'Enter Todo\'s title')) !!}
        {!! $errors->first('title', '<div class="alert alert-danger">:message</div>') !!}
      </div>

      <div class="form-group">
        {{--
          Output the "Completed" flag.
        --}}      
        {!! Form::checkbox('completed', 1, 0)  !!}
        {!! Form::label('completed', 'Completed'); !!}
      </div>

      <div class="form-group {!! $errors->has('todo') ? 'has-error' : '' !!}">
        {{--
          Output the "Description" textarea.
        --}}
        {!! Form::label('description', 'Description (optional)'); !!}
        {!! Form::textarea('description', '', array('class' => 'form-control')) !!}
      </div>

      {{--
        Output the submit button
      --}}
      {!! Form::submit('Submit !', array('class' => 'btn btn-sm btn-primary')) !!}

      <a href="javascript:location.href='{{ route('todos.index') }}'" class="btn btn-sm btn-success">
        <span class="glyphicon glyphicon-circle-arrow-left"></span> Back
      </a> 
    {!! Form::close() !!}
  </div>
@endsection

@section('navigation')
@endsection
