<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {
        if ($request->method() == 'POST') {
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
}
