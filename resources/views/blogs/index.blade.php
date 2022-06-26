@extends('layouts.main')

@section('content')

<h1 class="mb-5 mt-3">Blog Post</h1>

<div class="d-flex justify-content-end mb-3">
    <a href="{{route('blogs.create')}}" class="btn btn-success">Create</a>
</div>
<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search" name="search" value="{{ request('search') }}">
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th class="col-6">Title</th>
            <th class="col-3">Updated At</th>
            <th class="col-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $blog)
        <tr>
            <td>
                <a href="{{ route('blogs.show', $blog) }}">
                    {{ $blog->title }}
                </a>
            </td>
            <td>{{ $blog->updated_at->format('D M Y') }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{route('blogs.edit', compact('blog'))}}" class="btn btn-primary btn-sm mr-2">Edit</a>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{$blog->id}}">
                        Delete
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{$blog->id}}" tabindex="-1"
                        aria-labelledby="deleteModal{{$blog->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalTitle{{$blog->id}}">Detele Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">
                                    Are You Sure want to delete post with title <strong>{{ $blog->title }}</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">No</button>
                                    {{-- <button type="button" class="btn btn-danger">Yes</button> --}}
                                    <form action="{{route('blogs.delete', compact('blog'))}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-3">
    {{ $blogs->links() }}
</div>
</body>

@endsection