<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $blogs = Blog::with(['user', 'categories'])
            ->where('title', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(9)
            // ->withQueryString();
            ->appends($request->query());
        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        $blog->load(['user', 'comments.user', 'categories']);
        return view('blogs.show', compact('blog'));
    }

    public function storeComment(Blog $blog, Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $request->merge([
            'user_id' => auth()->id()
        ]);

        $blog->comments()->create($request->all());

        return redirect()->back();
    }
}
