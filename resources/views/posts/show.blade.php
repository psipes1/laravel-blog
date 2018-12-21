@extends('layouts.app')

@section('content')
  <br>
  <a href="/posts" class="btn btn-primary">Go back</a>
  <br>
  <br>
  <div class="card">
    <div class="card-body">
        <h1>{{$post->title}}</h1>
        <img src="/storage/cover_images/{{$post->cover_image}}">
        <div>
            <p>{!!$post->body!!}</p> 
            <!--"{" with 2 !! on each side} parses HTML -->
        </div>
        <hr>
        <small>Written on {{$post->created_at}} 
            by {{$post->user->name}}</small>
        <hr>

    @if(!Auth::guest())
          @if(Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
            Delete
          </button>
          @endif
      @endif
    </div>


  </div>

  


  <div id='deleteModal'class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h5 class="modal-title">Are you sure?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <p>Do you really want to delete: {{$post->title}}?</p>
          
          </div>
          <div class="modal-footer">
              {!! Form::open(['action' => ['PostController@destroy', $post->id], 'method' => 'POST']) !!}
              {{Form::hidden('_method', 'DELETE')}}
              <button type="submit" class="btn btn-danger">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {!! Form::close() !!}
            
          </div>
        </div>
      </div>
    </div>
     
<script>
  $(document).ready(function(){
    $('#deleteModal').modal()
});

  });

</script>

@endsection