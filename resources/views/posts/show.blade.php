@extends('layouts.app')

@section('content')
    <a style="margin-top: 2em" href="/posts" class="btn btn-light">Go Back</a>
    <h1>{{$post->title}}</h1>
    <img style="width: 100%" src="/storage/cover_image/{{$post->cover_image}}">
    <br><br>
    <div>
        {!! $post->body !!}
    </div>
    <hr>
    <small>written on {{$date}} by {{$post->user->name}} views {{$post->view_counter}}</small>
    <div calss="row">
        <button class="like rounded-circle btn btn-success">
            <i class="far fa-thumbs-up"></i>
        </button>
        <button class="like rounded-circle btn btn-danger">
            <i class="far fa-thumbs-down"></i>
        </button>
        <div id="post_id" class="d-none">{{$post->id}}</div>
    </div>
    <hr>
    <div>
        <h6>Tags</h6>
        @foreach($post->tags as $tag)
            <span class="badge badge-pill badge-primary">{{$tag->name}}</span>
        @endforeach
    </div>


    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <div style="display: flex;padding: 1em 0em">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>

                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="POST">
                    @method('delete')
                    @csrf
                    <input style="margin-left: 5em" type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        @endif
        // here before
    @endif
    <hr>
    <h4>Display Comments</h4>

    @include('posts.commentsDisplay', ['comments' => $post->comments, 'post_id' => $post->id])

    <hr/>
    <h4>Add comment</h4>
    <form method="post" action="{{ route('comments.store') }}">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="body1"></textarea>
            <input type="hidden" name="post_id" value="{{ $post->id }}"/>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Add Comment"/>
        </div>
    </form>
@endsection