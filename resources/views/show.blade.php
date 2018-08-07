@extends('master')

@section('content')

  <div class="msg hide alert alert-success alert-dismissible">&nbsp;</div>

  {{-- 
    Display the detail of a todo; make sure we've one
  --}}
  @isset($data)
    {{-- 
      Show information's like title, description and timestamps
    --}}
    <h3>{{ $data->title }}</h3>
    <p>{{ $data->description }}</p>
    <small>
      Created at: {{ $data->created_at }}
      <br/>
      Last updated: {{ $data->updated_at }}
      <br/>

      {{--
        $data->user isn't a column but, in our model, the user() function
        returns an object which represent a record of the users table.
        So, through $data->user we can access to the user's name, email, ...
      --}}
      Author: {{ $data->user->name }}
    </small>

  @endisset

@endsection

@section('navigation')
  @include('buttons.back')
  @auth 
    <span class="buttons">
      @include('buttons.edit')
      @include('buttons.delete')
    </span>
  @endauth
@endsection

@section('script')
{{--
  Add our script for our buttons
--}}
<script defer="defer">
  $('.delete, .edit').click(function(){

    if ($(this).hasClass('delete')) {

      // Add the csrf-token protection but only when the request is 
      // made on the same site (no cross-domain). 
      // Don't share the token outside
      $.ajaxSetup({
        beforeSend: function(xhr, type) {
          if (!type.crossDomain) {
              xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
          }
        }
      });

      // By clicking on the delete button, make an Ajax request
      $.ajax({
        url: '{{ route('todos.destroy', $data->id) }}',
        type: 'DELETE',
        contentType: 'application/json',
        success: function (data) {
          if (data.hasOwnProperty("message")) {
            // Show the message
            $('.msg').html(data.message).removeClass('hide');
            // And remove buttons.
            $('.buttons').remove();
            // The back button should refresh the page so don't 
            // use history.back() anymore
            $('.back').attr("href", "{{ route('todos.index') }}");
          }
        },
        error: function (data, textStatus, errorThrown) {
          console.log(data);
        }
      });
    } else {
      // The user has clicked on the edit button, redirect the browser
      // to the edit page
      window.location.replace('{{ route('todos.edit', ['id' => $data->id]) }}');
    }
});
</script>
@endsection
