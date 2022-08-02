@extends('layouts.dashboard.main')

@section('content')

<h1 class="mt-3 mb-5">Create Blog</h1>

<form action="{{route('dashboard.blogs.store')}}" method="POST" enctype="multipart/form-data">
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
        <label for="category">Category</label>
        <select id="category" class="form-control" name="category_id[]" multiple="multiple">
            {{-- VALUE AS ID IN CATEGORY --}}
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <img class="img-preview img-fluid mb-4 col-sm-2">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image"
            onchange="previewImage()">
        @error('image')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="body">Body</label>
        <input type="hidden" class="form-control @error('title') is-invalid @enderror" id="body" name="body"
            value="{{old('body')}}">
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
    const csrf_token = "{{csrf_token()}}";
    const categories_store_url = "{{route('dashboard.categories.store')}}";

    // previewImage
    function previewImage(){

        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<script src="{{URL::asset('/js/select2-conf.js')}}" defer></script>
@endsection