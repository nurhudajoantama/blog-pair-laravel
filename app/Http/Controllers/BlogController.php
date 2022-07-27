<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = request('search');
        $user = request('user');
        $category = request('category');

        $query = Blog::with(['user', 'categories'])
            ->where('title', 'like', '%' . $search . '%');
        if ($user) {
            $query = $query->whereHas('user', function ($query) use ($user) {
                $query->where('username', '=',  $user);
            });
        }
        if ($category) {
            $query = $query->whereHas('categories', function ($query) use ($category) {
                $query->where('name', '=',  $category);
            });
        }
        $blogs = $query->latest()
            ->paginate(9)
            ->appends($request->query());

        return view('blogs.index', compact('blogs'));
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
