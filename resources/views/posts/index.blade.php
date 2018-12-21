@extends('layouts.app')

@section('content')
  <h1>Posts</h1>

  @if(count($posts) > 0)
    @foreach($posts as $post)
    <div class="card bg-faded">
      <div class="card-body">
        <div class="col-md-4 col-sm-4">
            <img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100%;">
        </div>

        <div class="col-md-8 col-sm-8">
            <h1><a href="/posts/{{$post->id}}">{{$post->title}}</a></h1>
            <small>Written on {{$post->created_at}} 
              by {{$post->user->name}}</small>
        </div>
            
      </div>
 </div>

    @endforeach

    <br>
    <div class="float-right">
        {{$posts->links()}}
    </div>
    

  @else

    <h1>No Posts Found!</h1>

  @endif

@endsection