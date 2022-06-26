<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $blogs = Blog::paginate(8)->withQueryString();
        return view('index', compact('blogs'));
    }
}
