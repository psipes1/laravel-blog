@extends('layouts.app')

@section('content')
        
        <br>
        <div class="jumbotron text-center">
        <h1 class="display-4">{{$title}}</h1>
        <p class="lead">This is a Laravel App</p>
        <hr class="my-4">
        
        <p class="lead">
                <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
        </p>
        </div>
 @endsection
