@extends('layouts.main')

@section('content')

<h1>Create Blog</h1>

<form action="{{route('blogs.update', compact('blog'))}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value='{{ $blog->title }}'>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control" id="body" name="body" rows="3">{{ $blog->body }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

    @error('title')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('body')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    @error('slug')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</form>

@endsection