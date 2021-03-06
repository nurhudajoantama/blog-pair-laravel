@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>

@if ($blogs->count())
<div class="card mb-3">
    <img src="https://source.unsplash.com/1200x400/?nature,water" class="card-img-top" alt="...">
    <div class="card-body text-center">
        <h3 class="card-title"><a href="{{route('blogs.show', $latestBlog)}}" class="text-decoration-none text-dark">{{
                $latestBlog->title }}</a></h3>
        <p class="card-text">Dibuat oleh <strong>{{$latestBlog->user->name}}</strong></p>
        <p class="card-text">{{ $latestBlog->excerpt }}</p>
        <p class="card-text"><small class="text-muted">{{ $latestBlog->created_at->diffForHumans() }}</small></p>
        <a href="{{route('blogs.show', $latestBlog)}}" class="text-decoration-none">Read more</a>

    </div>
</div>


<div class="container">
    <div class="row mt-4">
        @foreach ($blogs as $blog)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <p class="card-text pb-2">Dibuat oleh <strong>{{$blog->user->name}}</strong></p>
                    <small class="card-subtitle mb-2 text-muted">{{$blog->created_at->diffForHumans() }}</small>
                    <p class="card-text">{{$blog->excerpt}}</p>
                    <a href="{{route('blogs.show', $blog)}}" class="card-link">Read More.</a>
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