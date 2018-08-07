@extends('master')

@section('content')

  <div class="panel-heading">Need to edit a Todo?</div>  

  <div class="panel-body">   

    {{-- 
      Messages sent by the controller like in
        return view('...')->with('message', '<div class="...">success</div>'))
      will be displayed here
    --}}
    @if(Session::has('message'))
      {!! Session::get('message') !!}
    @endif

    {!! Form::model($data, ['route' => ['todos.update', $data->id], 'method' => 'PUT']) !!}

      <div class="form-group {!! $errors->has('todo') ? 'has-error' : '' !!}"> 
        {{--
          Output the "Title" entry.
        --}}
        {!! Form::text('title', null, array('size' => '100', 'class' => 'form-control', 'placeholder' => 'Enter Todo\'s title')) !!}
        {!! $errors->first('title', '<div class="alert alert-danger">:message</div>') !!}
      </div>

      <div class="form-group">
        {{--
          Output the "Completed" flag.
        --}}      
        {!! Form::checkbox('completed', 1, null)  !!}
        {!! Form::label('completed', 'Completed'); !!}
      </div>

      <div class="form-group {!! $errors->has('todo') ? 'has-error' : '' !!}">
        {{--
          Output the "Description" textarea.
        --}}      
        {!! Form::label('description', 'Description (optional)'); !!}
        {!! Form::textarea('description', null, array('class' => 'form-control')) !!}
      </div>

      {{--
        Output the submit button
      --}}      
      {!! Form::submit('Submit !', array('class'=> 'btn btn-sm btn-primary')) !!}

      @include('buttons.back')

      {!! Form::close() !!}
  </div>
@endsection

@section('navigation')  
@endsection
