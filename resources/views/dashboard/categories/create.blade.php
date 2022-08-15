@extends('layouts.dashboard.main')

@section('content')

<h1 class="mt-3 mb-5">Create Category</h1>

<form action="{{route('dashboard.categories.store')}}" method="POST" >
    @csrf
    <select class="form-select" style="width: 100%;" name="parent_id">
        <option value="">None</option>
        @foreach ($parent_categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
        @endforeach
    </select>
    
   <div class="form-group">
        <label for="name">Category</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
            placeholder="name" value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection

