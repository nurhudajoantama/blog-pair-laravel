@extends('layouts.main')

@section('content')

<table>
    <thead>
        <tr>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $blog)
        <tr>
            <td>
                {{-- <a href="{{route('blogs.show')}}"> --}}
                    {{ $blog->title }}
                    {{-- </a> --}}
            </td>
            <td>{{ $blog->body }}</td>
            <td>{{ $blog->created_at }}</td>
            <td>{{ $blog->updated_at }}</td>
            <td>
                <a href="{{route('blogs.edit', compact('blog'))}}" class="btn btn-primary">Edit</a>
                <form action="{{route('blogs.delete', compact('blog'))}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>

@endsection