@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <h1>{{$title}}</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores corporis cum ducimus earum facere
            laudantium modi nam natus odio, perspiciatis porro possimus praesentium quae qui rem repudiandae tenetur
            voluptates. Odit!</p>
        <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    </div>
@endsection
