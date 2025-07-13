<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Display list of categories
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admin.categories', compact('categories') , ['page' => 'categories']);
    }

    // Show create form
    public function create()
    {
        $parentCategories = Category::whereNull('parentId')->get();
        return view('categories.create', compact('parentCategories'), ['page' => 'categories']);
    }

    // Store new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'parentId' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:75',
            'metaTitle' => 'nullable|string|max:100',
            'slug' => 'nullable|string|max:100',
            'content' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }
    // Show edit form
    public function edit(Category $category)
    {
        $parentCategories = Category::where('id', '!=', $category->id)
                                     ->whereNull('parentId')
                                     ->get();
        return view('categories.edit', compact('category', 'parentCategories') , ['page' => 'categories']);
    }

    // Update category
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'parentId' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:75',
            'metaTitle' => 'nullable|string|max:100',
            'slug' => 'nullable|string|max:100',
            'content' => 'nullable|string',
        ]);

        $validated['slug'] = $validated['slug'] ?? Str::slug($validated['title']);

        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Category deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->categories_ids);  // Tetap gunakan 'post_ids'

        if (count($ids) <= 1) {
            return redirect()->route('categories.index')->with('error', 'Please select more than one post.');
        }

        Category::whereIn('id', $ids)->delete();

        return redirect()->route('categories.index')->with('success', 'Selected posts deleted successfully.');
    }
}
