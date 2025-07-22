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
        'authorId',
        'pinned'
    ];
    protected $casts = [
    'publishedAt' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId');
    }

    public function setPinnedAttribute($value)
    {
        $this->attributes['pinned'] = $value ? 1 : 0;
    }

    // Hitung jumlah kata pada konten post
    public function wordCount()
    {
        return str_word_count(strip_tags($this->content));
    }

    // Estimasi waktu baca (dalam menit), rata-rata orang membaca 200 kata/menit
    public function readingTime()
    {
        $words = $this->wordCount();
        $minutes = ceil($words / 200);
        return $minutes;
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag')->withTimestamps();;
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id');
    }

    

    

    


}
