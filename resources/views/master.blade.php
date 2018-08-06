<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{--
    Important for our Ajax requests: we need to protect our server's requests
    with the generated session token
  --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Some stupid Todos application</title>
  {!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') !!}
	{!! Html::style('https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css') !!}  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <style>textarea { max-height:150px; }</style>
</head>
<body>
  <main role="main">
    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Some stupid Todos application</h1>
        <small>A simple Laravel application, learning purposes</small>
      </div>
    </div>
  </main>
  <div class="container">
    @yield('content')
    <hr/>
    @yield('navigation')
  </div>
  @yield('script')
</body>
</html>
