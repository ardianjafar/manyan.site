<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\Contracts\Viewable as ViewableContract;
use CyrildeWit\EloquentViewable\InteractsWithViews;

class Post extends Model implements ViewableContract
{
    use HasFactory, InteractsWithViews;
    protected $fillable = [
        'title',
        'metaTitle',
        'slug',
        'content',
        'summary',
        'publishedAt',
        'published',
        'image',
        'authorId'
    ];
    protected $casts = [
    'publishedAt' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }
}
