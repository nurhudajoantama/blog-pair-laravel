@extends('layouts.main')

@section('content')

<h1>{{$blog->title}}</h1>
<div>
    Dibuat oleh
    <a href="{{route('blogs.index',['user'=>$blog->user->username])}}">
        <strong class="text-capitalize text-dark">
            <u>{{$blog->user->name}}</u>
        </strong>
    </a>
</div>
<div>
    Dibuat pada <strong>{{$blog->created_at->format('d M Y')}}</strong>
</div>
<div>
    @foreach ($blog->categories as $category)
    <a href="{{route('blogs.index',['category' => $category->name])}}" class="text-decoration-none">
        <span class="badge  bg-primary text-white text-capitalize px-3 py-1 ">
            {{ $category->name }}
        </span>
    </a>
    @endforeach
</div>
<p class="mt-3">{!! $blog->body !!}</p>


<a href="/blogs">Back to post</a>
<div class="mt-5">
    <div>
        <h3 class="border-bottom mb-4" style="margin-top: 150px ">Comments</h3>
        @foreach ($blog->comments as $comment)
        <div class="mb-4">
            <div>
                <strong>{{$comment->user->name}}</strong>
                <small class="mb-2">
                    {{$comment->created_at->diffForHumans()}}
                </small>
            </div>
            <div>
                {{$comment->comment}}
            </div>
        </div>
        @endforeach
    </div>

    @auth
    <form class="mt-2" action="{{route('blogs.storeComment', $blog)}}" method="post">
        @csrf
        <textarea class="form-control" name="comment" rows="3"></textarea>
        <button type="submit" class="btn btn-primary mt-1">Comment</button>
    </form>
    @else
    <div>
        <center>
            <a href="/login" class="mt-1">Login to comment</a>
        </center>
    </div>
    @endauth
</div>


@endsection