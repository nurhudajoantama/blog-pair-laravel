@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>


<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>


<nav class="navbar navbar-expand-lg bg-light py-0">
    <div id="navbarNav">
        <ul class="navbar-nav text-dark">
            <li class="nav-item">
                <button class="btn btn-link nav-link py-1 text-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#userNav" aria-expanded="false" aria-controls="userNav">
                    Users
                </button>
            </li>
            <li class="nav-item">
                <button class="btn btn-link nav-link py-1 text-secondary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#tagNavbar" aria-expanded="false" aria-controls="tagNavbar">
                    Tags
                </button>
            </li>
        </ul>
    </div>
</nav>

<div class="accordion accordion-flush mt-3 mt-2" id="accordionFlushExample">
    <div class="accordion-item">
        <div id="userNav" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
            data-bs-parent="#accordionFlushExample">
            <div class="accordion-body">
                <h5 class="mb-2">
                    Users
                </h5>
                <div class="row">
                    @foreach ($users as $user)
                    <a class="col-md-3 mb-1 text-dark text-capitalize"
                        href="{{route('blogs.index',['user' => $user->username])}}">
                        {{ $user->name }}
                    </a>
                    @endforeach
                </div>
                <hr />
            </div>
        </div>
        <div class="accordion-item">
            <div id="tagNavbar" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <h5 class="mb-2">
                        Tags
                    </h5>
                    <div class="row">
                        @foreach ($tags as $tag)
                        <a class="col-md-3 mb-1 text-dark text-decoration-none"
                            href="{{route('blogs.index',['tag' => $tag->name])}}">
                            <span class="badge bg-primary text-white text-capitalize px-3 py-1 ">
                                {{ $tag->name }}
                            </span>
                        </a>
                        @endforeach
                    </div>
                    <hr />
                </div>
            </div>
        </div>
    </div>


    @if(request('user'))
    <div>
        <p>Username : <strong>{{request('user')}}</strong></p>
    </div>
    @endif

    {{-- @if(request('tag'))
    <div>
        <p>tag :
            <span class="badge bg-primary text-white text-capitalize px-3 py-1 ">
                {{request('tag')}}
            </span>
        </p>
    </div>
    @endif --}}

    @if ($blogs->count())
    <div class="row mt-4">
        @foreach ($blogs as $blog)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    @if ($blog->image)
                    <div>
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}"
                            class="img-fluid card-img-top">
                    </div>
                    @endif
                    <h5 class="card-title">{{$blog->title}}</h5>
                    <small class="card-text fs-6">Dibuat oleh
                        <a class="text-dark" href="{{route('blogs.index',['user'=>$blog->user->username])}}">
                            <strong class="text-capitalize">
                                <u>{{$blog->user->name}}</u>
                            </strong>
                        </a>
                    </small>
                    <div>
                        @foreach ($blog->tags as $tag)
                        <span class="text-success ">
                            <a class="text-decoration-none" href="{{route('blogs.index',['tag'=>$tag->name])}}">
                                <span class="badge  bg-primary text-white text-capitalize px-3 py-1">
                                    {{ $tag->name }}
                                </span>
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