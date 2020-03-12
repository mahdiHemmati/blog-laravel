@extends('layouts.app')
@php
    use Hekmatinasser\Verta\Verta;
@endphp

@section('content')

    <div class="d-flex flex-row justify-content-between">

        <h1>Posts</h1>

        <div class="d-flex flex-row justify-content-between">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                Category
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/posts/category/blog">Blog</a>
                <a class="dropdown-item" href="/posts/category/nabzography">Nabzography</a>
                <a class="dropdown-item" href="/posts/category/news">News</a>
            </div>
            <form id="index-search-form" class="form-inline my-2 my-lg-0">
                <input id="index-search-input" class="form-control mr-sm-2" type="search" placeholder="Search"
                       aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>


    </div>

    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well">
                <div class="row border pt-2 pb-2 shadow-sm mb-5 mt-5 slide">
                    <div class="col-md-4">
                        <div class="n-img-container"
                             style="background-image: url('/storage/cover_image/{{$post->cover_image}}')">
                        </div>

                        {{--<div class="n-img-container"></div>--}}
                    </div>
                    <div class="col-md-8">
                        <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                        <small>Written on {{new Verta($post->created_at)}} by {{$post->user->name}}
                            view {{$post->view_counter}}</small>
                        <div style="margin-top: 1em">
                            <h6>Tags</h6>
                            @foreach($post->tags as $tag)

                                <span class="badge badge-pill badge-primary">
                                     <a class="n-tag" href="/posts/tags/category/{{$tag->name}}/{{$post->category}}">
                                        {{$tag->name}}
                                     </a>
                                </span>


                            @endforeach
                        </div>
                        <h6 class="mt-3">Category</h6>
                        <small>{{$post->category}}</small>
                        <div>
                        <i class="far fa-thumbs-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{$posts->links()}}
    @else
        <p>No Posts Found</p>
    @endif
@endsection