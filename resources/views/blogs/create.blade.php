@extends('layouts.main')

@section('content')

<h1 class="mt-3 mb-5">Create Blog</h1>

<form action="{{route('blogs.store')}}" method="POST">
    @csrf
    <div class="form-group">
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            placeholder="Title" value="{{old('title')}}">
        @error('title')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <textarea class="form-control @error('title') is-invalid @enderror" id="body" name="body"
            rows="3">{{old('body')}}</textarea>
        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection