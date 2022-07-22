@extends('layouts.dashboard.main')

@section('content')

<h1>Edit Blog</h1>

<form action="{{route('dashboard.blogs.update', $blog)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        @error('slug')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="title">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
            placeholder="Title" value="{{ old('title', $blog->title) }}">
        @error('title')
        <div class=" invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="category">Category</label>
        <select id="category" class="form-control" name="category_id[]" multiple="multiple">
            {{-- VALUE AS ID IN CATEGORY --}}
            @foreach ($categories as $category)
            <option value="{{$category->id}}" @if ($blog->categories->contains($category))
                selected
                @endif
                >{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <input type="hidden" class="form-control @error('title') is-invalid @enderror" id="body" name="body"
            value="{{old('body', $blog->body)}}">
        <trix-editor input="body"></trix-editor>
        @error('body')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

</form>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#category').select2({
            language: {
            noResults: function (e) {
                return ```
                No Results Found 
                <a href='#' class='btn btn-danger'>Use it anyway</a>
                ```;
            }
        },
        escapeMarkup: function (markup) {
        return markup;
        }
        });
    });
</script>
@endsection