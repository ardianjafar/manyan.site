<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\EducationalWord;
use App\Models\Category;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use Mpdf\Mpdf;


class BlogController extends Controller
{
    public function index()
    {
       $posts = Post::where('published', true)
        ->orderBy('pinned', 'desc')    // pinned first!
        ->orderBy('publishedAt', 'desc')
        ->paginate(10);                // gunakan jumlah sesuai kebutuhan

        return view('blog.index', compact('posts'));
        return view('blog.index', [
            'posts' => $posts,
            'metaTitle' => $post->metaTitle ?? $post->title,
            'metaDescription' => $post->summary ?? Str::limit(strip_tags($post->content), 160),
        ]);
    }

    public function about()
    {
        return view('blog.about-me');
    }
    

    public function show($slug)
    {
        $post = Post::with('categories', 'author')->where('slug', $slug)->firstOrFail();   // Securely find the post or throw 404
        views($post)->record();

        // Ambil related post (berdasarkan kategori yang sama dan slug berbeda)
        $relatedPosts = Post::where('slug', '!=', $post->slug)
            ->where('published', true)
            ->orderBy('publishedAt', 'desc')
            ->limit(3)
            ->get();

        return view('blog.blog-post', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'metaTitle' => $post->metaTitle ?? $post->title,
            'metaDescription' => $post->summary ?? Str::limit(strip_tags($post->content), 160),
        ]);

    }

    public function education(Request $request)
    {
        $query = EducationalWord::query();

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan level jika ada
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Urutkan berdasarkan kata jika ada parameter sort
        if ($request->filled('sort')) {
            $query->orderBy('word_en', $request->sort);
        }

        // Ambil data (semua atau paginate tergantung checkbox)
        if ($request->has('all') && $request->all) {
            // Batasi maksimal 200 record
            $words = $query->limit(200)->paginate(200)->withQueryString();
        } else {
            $words = $query->paginate(25)->withQueryString();
        }

        // Untuk dropdown
        $levels = EducationalWord::select('level')->distinct()->pluck('level');
        $categories = Category::all();

        return view('blog.education', compact('words', 'levels', 'categories'));
    }

    public function exportPdf(Request $request)
    {
        $query = EducationalWord::query();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        if ($request->filled('sort')) {
            $query->orderBy('word_en', $request->sort);
        }

        $words = $request->has('all') && $request->all
            ? $query->limit(200)->get()
            : $query->paginate(20);

        // Render ke view (tanpa layout)
        $html = view('blog.export-pdf', compact('words'))->render();

        // Buat PDF pakai MPDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        return response($mpdf->Output('words.pdf', \Mpdf\Output\Destination::STRING_RETURN))
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'attachment; filename="words.pdf"');
    }


}


