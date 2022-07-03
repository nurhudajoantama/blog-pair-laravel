<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::with(['user'])
            ->where('title', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(9)
            // ->withQueryString();
            ->appends($request->query());
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
