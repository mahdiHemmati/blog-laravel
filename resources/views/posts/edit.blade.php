@extends('layouts.app')

@section('content')
    <h1>edit Post</h1>

    <form action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data">
        @method('put')
        @csrf

        <div class="form-group">
            <label>Title</label>
            <input type="text" value="{{$post->title}}" placeholder="title" name="title" class="form-control">
        </div>

        <div class="form-group">
            <label>Body</label>
            <textarea placeholder="body text" name="body" class="form-control">{{$post->body}}</textarea>
        </div>

        <div class="d-flex flex-row">
            <div class="form-group col-md-8 pl-0">
                <label>Tags</label>
                <input type="text" value="{{$post->tagList}}" placeholder="tags" name="tags" class="form-control">
            </div>
            <div class="form-group md-4">
                {{--<label>Category</label>--}}
                {{--<input type="text" value="{{$post->category}}" name="category" class="form-control">--}}
                <label for="exampleFormControlSelect1">Category</label>
                <select class="form-control" id="exampleFormControlSelect1" name="category">
                    <option>BLOG</option>
                    <option>NABZOGRAPHY</option>
                    <option>NEWS</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <input type="file" name="cover_image">
        </div>

        <input type="submit" value="Submit" class="btn btn-primary">
    </form>

@endsection