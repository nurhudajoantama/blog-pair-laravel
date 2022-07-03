@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>


<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

@if ($blogs->count())
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
@else
<p class="text-center fs-4">No post found.</p>
@endif

<div class="mt-3">
    {{ $blogs->links() }}
</div>

@endsection