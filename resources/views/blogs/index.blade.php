@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>


<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>

@if(request('user'))
<div>
    <p>Username : <strong>{{request('user')}}</strong></p>
</div>
@endif

@if(request('category'))
<div>
    <p>Category : <strong>{{request('category')}}</strong></p>
</div>
@endif

@if ($blogs->count())
<div class="row mt-4">
    @foreach ($blogs as $blog)
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$blog->title}}</h5>
                <small class="card-text fs-6">Dibuat oleh <a
                        href="{{route('blogs.index',['user'=>$blog->user->username])}}">
                        <strong>{{$blog->user->name}}</strong></small>
                </a>
                <div>
                    @foreach ($blog->categories as $category)
                    <span class="text-success ">
                        <a href="{{route('blogs.index',['category'=>$category->name])}}">
                            <strong>{{ $category->name }}</strong>
                        </a>
                    </span>
                    @endforeach
                </div>
                <small class="card-text mt-3 text-muted">{{$blog->created_at->diffForHumans() }}</small>
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