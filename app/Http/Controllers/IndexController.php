<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        // if(request('search')) {
        //     $posts->where('title', 'like', '%'. request('search'). '%');
        // }

        $blogs = Blog::where('title', 'like', '%' . request('search') . '%')
            ->latest()
            ->paginate(8)
            ->withQueryString();
        return view('index', compact('blogs'));
    }
}
