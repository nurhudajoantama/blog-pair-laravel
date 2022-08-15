<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        // $categories = Category::with(['subcategory'])->where('parent_id', null)->get();
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'parent_id' => 'nullable|numeric'
        ]);

        Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id
        ]);

        return redirect()->back()->with('success', 'Category has been created successfully.');
    }
}
