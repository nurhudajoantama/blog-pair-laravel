<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\TAg;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = request('search');
        $user = request('user');
        $tag = request('tag');

        $query = Blog::with(['user', 'tags']);
        if ($search) {
            $query = $query->where('title', 'like', '%' . $search . '%');
        }
        if ($user) {
            $query = $query->whereHas('user', function ($query) use ($user) {
                $query->where('username', '=',  $user);
            });
        }
        if ($tag) {
            $query = $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('name', '=',  $tag);
            });
        }
        $blogs = $query->latest()
            ->paginate(9)
            ->appends($request->query());
        $tags = Tag::has('blogs')->get();
        $users = User::has('blogs')->get();

        return view('blogs.index', compact('blogs', 'tags', 'users'));
    }

    public function show(Blog $blog)
    {
        $blog->load(['user', 'tags',]);
        $comments = $blog->comments()->whereNull('parent_id')
            ->with(['replies'])
            ->get();
        return view('blogs.show', compact('blog', 'comments'));
    }
}
