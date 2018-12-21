@extends('layouts.app')

@section('content')
<br>

<h1>Create Page</h1>
     
{!! Form::open(['action' => 'PostController@store', 'method' => 'POST','enctype' => 'multipart/form-data']) !!}

    <div class="form-group">
      {{Form:: label('title', 'Title')}}
      {{Form:: text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
      <br>
      {{Form:: label('body', 'Body')}}
      {{Form:: textarea('body', '', ['class' => 'form-control post_editor', 'placeholder' => 'Body', 'id' => 'article-ckeditor'])}}
      <br>
      <div class="form-control-file">
      {{Form:: file('cover_image')}}
      </div>
      <br>
      {{Form:: submit('Submit', ['class' => 'btn btn-primary'])}}

    </div>
{!! Form::close() !!}

@endsection

   