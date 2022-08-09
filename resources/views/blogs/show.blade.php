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
    @foreach ($blog->tags as $tag)
    <a href="{{route('blogs.index',['tag' => $tag->name])}}" class="text-decoration-none">
        <span class="badge  bg-primary text-white text-capitalize px-3 py-1 ">
            {{ $tag->name }}
        </span>
    </a>
    @endforeach
</div>
@if ($blog->image)
<div style="width: 300px">
    <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid">
</div>
@endif

<p class="mt-3">{!! $blog->body !!}</p>

<a href="/blogs">Back to post</a>
<div class="mt-5 mb-3">
    <div>
        <h3 class="border-bottom mb-4" style="margin-top: 150px ">Comments</h3>
        <div>
            @foreach ($comments as $comment)
            <div class="mb-4">
                <div>
                    <strong>{{$comment->user->name}}</strong>
                    <small class="mb-2">
                        {{$comment->created_at->diffForHumans()}}
                    </small>
                    <small class="mb-2">
                        @if(auth()->id() == $comment->user_id)
                        <form class="d-inline" action="{{ route('blogs.comment.destroy',compact('blog','comment')) }}"
                            method="post">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                        @endif
                    </small>
                </div>
                <div>
                    {{$comment->comment}}
                </div>
                @auth
                <form class="mt-2 mb-3" action="{{route('blogs.comment.reply.store', $blog)}}" method="post">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                    <div class="row">
                        <div class="col-11">
                            <textarea class="form-control" name="comment" rows="1" placeholder="reply"></textarea>
                        </div>
                        <div class="col-1">
                            <button type="submit" class="btn btn-primary">Reply</button>
                        </div>
                    </div>
                </form>
                @endauth
                <div>
                    @include('blogs.partials._comment_replies', ['comments' => $comment->replies])
                </div>
            </div>
            @endforeach
        </div>
    </div>

    @auth
    <form class="mt-2" action="{{route('blogs.comment.store', $blog)}}" method="post">
        @csrf
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment"></textarea>
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