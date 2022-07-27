<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function API_getAllCategories()
    // {
    //     $categories = Category::all();
    //     return response()->json($categories);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,name'
        ]);
        $category = Category::create([
            'name' => $request->category_name
        ]);
        return response()->json($category);
    }
}
