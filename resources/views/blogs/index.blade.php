@extends('layouts.main')

@section('content')

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $blog)
        <tr>
            <td>{{ $blog->id }}</td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->body }}</td>
            <td>{{ $blog->created_at }}</td>
            <td>{{ $blog->updated_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</body>


@endsection