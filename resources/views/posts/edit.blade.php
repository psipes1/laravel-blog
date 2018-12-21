@extends('layouts.app')

@section('content')
<br>

<h1>Edit</h1>
     
{!! Form::open(['action' => ['PostController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
      {{Form:: label('title', 'Title')}}
      {{Form:: text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
      <br>
      {{Form:: label('body', 'Body')}}
      {{Form:: textarea('body', $post->body, ['class' => 'form-control', 'placeholder' => 'Body', 'id' => 'article-ckeditor'])}}
      <br>
          <div class="form-control-file">
          {{Form:: file('cover_image')}}
          </div>
      <br>
      {{Form::hidden('_method', 'PUT')}}
      {{Form:: submit('Submit', ['class' => 'btn btn-primary'])}}

    </div>
{!! Form::close() !!}

@endsection