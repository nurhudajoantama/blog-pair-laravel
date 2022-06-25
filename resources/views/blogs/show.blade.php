@extends('layouts.main')

@section('content')

<h1>{{$blog->title}}</h1>
<div>
    Dibuat pada <strong>{{$blog->created_at->format('d M Y')}}</strong>
</div>
<p class="mt-3">{!! $blog->body !!}</p>

@endsection