@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>

<div class="row">
    @foreach ($blogs as $blog)
    <div class="col-4 ">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title pb-2">{{$blog->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text">{{$blog->excerpt}}</p>
                <a href="{{route('blogs.show', $blog)}}" class="card-link">Read More.</a>
            </div>
        </div>
    </div>
    @endforeach
</div>

@endsection