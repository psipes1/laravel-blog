@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h1>Your Posts...</h1>
                    <br>  
                    @if(count($posts) > 0)
                    <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    <br>
                    <br>  
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                                
                            </tr>

                            @foreach($posts as $post)
                                <tr>
                                    <td>{{$post->title}}</td>
                                    <td><a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                    <td><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePost">Delete</button></td>
                                </tr>

                            @endforeach

                           
                              @else
                           

                            <h3>You have no posts, create one!</h3>
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        </table>

                        @endif

                        <!-- Modal  -->
                        <div id='deletePost'class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-light">
              <h5 class="modal-title">Are you sure?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
      <div class="modal-body">
            <p>Do you really want to delete this post ?</p>
            
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


      
            </div>
        </div>
    </div>
</div>
</div>


@endsection


       
  <script>
    $(document).ready(function(){
      $('#deletePost').modal()
  });
  
  </script>
