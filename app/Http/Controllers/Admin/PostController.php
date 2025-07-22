<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Subscriber;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller {

    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('admin.index', [
            'posts' => $posts,
            'page' => "posts"
        ]);
    }

    public function create()
    {
        $categories = Category::all(); // or where('parentId', null) if needed
        $tags = Tag::all(); // or where('parentId', null) if needed
        return view('posts.create', [
            'categories' => $categories,
            'page' => 'posts',
            'tags' => $tags
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();

        $validated['pinned'] = $request->has('pinned') ? 1 : 0;
        $validated['publishedAt'] = \Carbon\Carbon::now();
        $validated['authorId'] = auth()->id();
        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }

        $post = Post::create($validated);  // ← ini penting!

        $post->categories()->attach($request->input('categories', []));
        $post->tags()->attach($request->input('tags', []));
        
        foreach(Subscriber::all() as $subscriber) {
            Mail::to($subscriber->email)->queue(new NewPostNotification($post));
        }
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
        
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        $tags = Tag::all();
        $postCategories = $post->categories->pluck('id')->toArray();

        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
            'postCategories' => $postCategories,
            'page' => 'posts'
        ]);
    }

   
    public function update(UpdatePostRequest $request, Post $post)
    {
        $pinnedValue = $request->has('pinned') ? 1 : 0;
         $validated = $request->validated();

        if (empty($validated['image'])) {
            $validated['image'] = $post->image;
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }
        $validated['pinned'] = $pinnedValue;
        $post->update($validated);
        $post->categories()->sync($request->input('categories', []));
        $post->tags()->sync($request->input('tags', []));
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }


    public function show(Post $post)
    {
        $post->load('categories');

        return view('posts.show', compact('post'), ['page' => 'posts']);
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
