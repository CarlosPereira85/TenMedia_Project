<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'You are not authorized to create a category.');
        }

        return view('categories.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'You are not authorized to create a category.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'You are not authorized to edit this category.');
        }

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'You are not authorized to update this category.');
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('categories.index')->with('error', 'You are not authorized to delete this category.');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
