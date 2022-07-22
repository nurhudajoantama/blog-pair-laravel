<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

class DashboardBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('title', 'like', '%' . request('search') . '%')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10)
            ->withQueryString();
        return view('dashboard.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|min:3|unique:blogs',
            'body' => 'required|min:3',
            'category_id' => 'exists:categories,id',
        ]);
        $request->merge([
            'excerpt' => Str::limit(strip_tags($request->body, 35)),
            'user_id' => auth()->id()
        ]);
        $blog = Blog::create($request->all());
        $blog->categories()->attach($request->category_id);
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog created successfully');
    }

    public function edit(Blog $blog)
    {
        if (!Gate::allows('update-blog', $blog)) {
            abort(403);
        }
        $categories = Category::all();
        $blog->load('categories');
        return view('dashboard.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->merge(['slug' => Str::slug($request->title)]);
        $request->validate([
            'title' => 'required|min:3',
            'slug' => 'required|min:3|unique:blogs,slug,' . $blog->id,
            'body' => 'required|min:3',
            'category_id' => 'exists:categories,id',
        ]);
        $request->merge(['excerpt' => Str::limit(strip_tags($request->body, 35))]);
        $blog->update($request->all());
        $blog->categories()->sync($request->category_id);
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog updated successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('dashboard.blogs.index')->with('success', 'Blog deleted successfully');
    }
}
