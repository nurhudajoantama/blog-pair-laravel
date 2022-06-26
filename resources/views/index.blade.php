@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>

<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

<div class="row mt-4">
    @foreach ($blogs as $blog)
    <div class="col-4 mb-3">
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

<div class="mt-3">
    {{ $blogs->links() }}
</div>

@endsection