@extends('layouts.main')

@section('content')

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
                    <form action="{{route('blogs.delete', compact('blog'))}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>

@endsection