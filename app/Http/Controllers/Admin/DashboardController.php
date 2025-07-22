<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalViews = views(Post::class)->count();
        $postPublished = Post::get('published')->count();
        $draftPosts = Post::where('published', false)->count();
        return view('admin.dashboard', compact('totalViews','postPublished','draftPosts'),['page' => 'dashboard']);
    }

    // $viewsPerMonth = $dashboard->viewsPerMonth();
    // $mostViewedPosts = $dashboard->mostViewedPosts();
    // $summary = $dashboard->postSummary();

    // return view('admin.dashboard', [
    //     'viewsPerMonth' => $viewsPerMonth,
    //     'mostViewedPosts' => $mostViewedPosts,
    //     'summary' => $summary,
    // ]);
}
