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
                        <div class="container">
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                            <h3>Your Blog Posts</h3>

                            @if(count($posts) > 0 )
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->title}}</td>
                                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-dark">Edit</a></td>
                                            <td>
                                                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                                                    @method('delete')
                                                    @csrf

                                                    <input type="submit" value="Delete" class="btn btn-danger">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                @else
                                    <p>You have no post</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
