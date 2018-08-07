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
        @include('buttons.show')
        @auth 
          @include('buttons.edit')
          @include('buttons.delete')
        @endauth 
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
  @include('buttons.add')
  
@endsection
