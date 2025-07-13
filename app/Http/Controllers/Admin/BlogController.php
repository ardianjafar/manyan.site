<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\EducationalWord;
use CyrildeWit\EloquentViewable\Contracts\Viewable;


class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::where('published', true)->orderBy('publishedAt', 'desc')->paginate(6);
        return view('blog.index', compact('posts'));
    }

    public function about()
    {
        return view('blog.about-me');
    }

    public function show($id)
    {
        $post = Post::with('categories', 'author')->where('id', $id)->firstOrFail();   // Securely find the post or throw 404
        views($post)->record();

        // Ambil related post (berdasarkan kategori yang sama dan id berbeda)
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('published', true)
            ->orderBy('publishedAt', 'desc')
            ->limit(3)
            ->get();

        return view('blog.blog-post', compact('post', 'relatedPosts'));

    }

    public function education(Request $request)
    {
        $level = $request->query('level'); // ambil filter level dari URL

        $query = EducationalWord::query();

        if ($level) {
            $query->where('level', $level);
        }

        $words = $query->get();
        $words = $query->paginate(10);

        // Ambil semua level unik dari DB untuk filter dropdown
        $levels = EducationalWord::select('level')->distinct()->pluck('level');

        return view('blog.education', compact('words', 'level', 'levels'));
    
    }

}


