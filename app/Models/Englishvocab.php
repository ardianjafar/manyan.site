<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Englishvocab extends Model
{
    use HasFactory;
    
    protected $table = 'english_vocab';
    protected $fillable = [
        'category_id','word_en', 'word_id', 'type', 'example_en', 'example_id', 'level',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
