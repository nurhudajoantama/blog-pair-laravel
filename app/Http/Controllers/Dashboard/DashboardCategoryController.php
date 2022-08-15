<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with(['subcategory'])->whereNull('parent_id')->get();
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
    public function create()
    {
        $parent_categories = Category::whereNull('parent_id')->get();
        return view('dashboard.categories.create', compact('parent_categories'));
    }
}
