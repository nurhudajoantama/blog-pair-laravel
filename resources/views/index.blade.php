@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>

@if ($blogs->count())
<div class="card mb-3">
    <img src="https://source.unsplash.com/1200x400/?nature,water" class="card-img-top" alt="...">
    <div class="card-body text-center">
        <h3 class="card-title"><a href="{{route('blogs.show', $blogs[0])}}" class="text-decoration-none text-dark">{{
                $blogs[0]->title }}</a></h3>
        <small class="card-text">Dibuat oleh <strong>{{$blogs[0]->user->name}}</strong></small>
        <p class="card-text">{!! $blogs[0]->excerpt !!}</p>
        <p class="card-text"><small class="text-muted">{{ $blogs[0]->created_at->diffForHumans() }}</small></p>
        <div class="card-text">
            @foreach ($blogs[0]->categories as $category)
            <span class="text-success "><b>{{ $category->name }}</b></span>
            @endforeach
        </div>
        <a href="{{route('blogs.show', $blogs[0])}}" class="text-decoration-none">Read more</a>

    </div>
</div>


<div class="container">
    <div class="row mt-4">
        @foreach ($blogs->skip(1) as $blog)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <small class="card-text pb-2">Dibuat oleh <strong>{{$blog->user->name}}</strong></small>
                    <div class="card-text">
                        @foreach ($blog->categories as $category)
                        <span class="text-success"><b>{{ $category->name }}</b></span>
                        @endforeach
                    </div>
                    <p class="card-text mb-1">{{$blog->excerpt}}</p>
                    <a href="{{route('blogs.show', $blog)}}" class="card-link">Read More</a>
                    <div class="mt-2">
                        <small class="card-subtitle text-muted">{{$blog->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@else
<p class="text-center fs-4">No post found.</p>
@endif

@endsection