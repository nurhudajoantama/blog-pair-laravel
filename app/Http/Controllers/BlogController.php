<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|min:3|unique:blogs',
            'body' => 'required|min:3',
        ]);
        $request->merge(['excerpt' => Str::limit(strip_tags($request->body, 35))]);
        Blog::create($request->all());
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
    }
}
