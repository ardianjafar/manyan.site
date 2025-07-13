<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_en', 'word_id', 'type', 'example_en', 'example_id', 'level',
    ];
}
