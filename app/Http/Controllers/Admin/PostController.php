<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PostController extends Controller {
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('admin.index', compact('posts'), ['page' => "posts"]);
    }

    public function create()
    {
        $categories = Category::all(); // or where('parentId', null) if needed
        return view('posts.create', compact('categories'), ['page' => 'posts']);
    }

    public function store(Request $request)
    {
        
        
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'metaTitle' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:100',
            'image' => 'string',
            'summary' => 'nullable|string|max:100',
            'publishedAt' => 'nullable|date',
            'published' => 'required|boolean',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        $validated['authorId'] = auth()->id();

        $post = Post::create($validated);  // ← ini penting!

        $post->categories()->attach($request->input('categories', []));

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $postCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'postCategories'), ['page' => 'posts']);
    }

   
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'categories' => 'array',
            'categories.*' => 'exists:categories,id',
            'metaTitle' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'summary' => 'nullable|string|max:100',
            'publishedAt' => 'nullable|date',
            'published' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        $post->update($validated);
        $post->categories()->sync($request->input('categories', []));
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function show(Post $post)
    {
        $post->load('categories');

        return view('posts.show', compact('post'));
    }

    public function destroy(Post $post)
    {
        // Optional: Delete associated image file if exists
        if ($post->image && \Storage::disk('public')->exists($post->image)) {
            \Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->post_ids);  // Tetap gunakan 'post_ids'

        if (count($ids) <= 1) {
            return redirect()->route('posts.index')->with('error', 'Please select more than one post.');
        }

        Post::whereIn('id', $ids)->delete();

        return redirect()->route('posts.index')->with('success', 'Selected posts deleted successfully.');
    }



}
