<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tag_name' => 'required|unique:tags,name'
        ]);
        $tag = Tag::create([
            'name' => $request->tag_name
        ]);
        return response()->json($tag);
    }
}
