<?php 
namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function viewsPerMonth()
    {
        return DB::table('posts')
            ->select(DB::raw('DATE_FORMAT(publishedAt, "%Y-%m") as month'), DB::raw('SUM(views) as total_views'))
            ->whereNotNull('publishedAt')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function mostViewedPosts($limit = 5)
    {
        return Post::orderBy('views', 'desc')->take($limit)->get(['title', 'views']);
    }

    public function postSummary()
    {
        return [
            'total_views'     => Post::sum('views'),
            'total_comments'  => DB::table('comments')->count(),
            'total_published' => Post::where('published', true)->count(),
            'total_draft'     => Post::where('published', false)->count(),
        ];
    }
}
