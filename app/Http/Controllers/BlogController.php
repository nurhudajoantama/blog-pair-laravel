<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('title', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(9)
            ->withQueryString();
        return view('blogs.index', compact('blogs'));
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
