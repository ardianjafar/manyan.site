<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $posts = Post::where('title', 'like', "%{$query}%")
                     ->orWhere('summary', 'like', "%{$query}%")
                     ->get();

        $categories = Category::where('title', 'like', "%{$query}%")
                              ->orWhere('content', 'like', "%{$query}%")
                              ->get();

        return view('admin.search-results', compact('query', 'posts', 'categories'));
    }
}

