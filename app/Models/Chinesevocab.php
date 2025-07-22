<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chinesevocab extends Model
{
    use HasFactory;
    protected $table = 'vocabularies_mandarin';
    protected $fillable = ['hanzi', 'pinyin', 'meaning', 'type', 'example_cn', 'example_id', 'level'];
}
