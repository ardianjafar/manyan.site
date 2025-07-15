<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        $categories = [
            [
                'title' => 'English for Jobs',
                'metaTitle' => 'Vocabulary for job interviews',
                'slug' => Str::slug('English for Jobs'),
                'content' => 'Learn vocabulary for job interviews & workplace.',
                'parentId' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Preparing Interview',
                'metaTitle' => 'Interview preparation',
                'slug' => Str::slug('Preparing Interview'),
                'content' => 'Practice expressions & questions for interviews.',
                'parentId' => null,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Beginner Vocabulary',
                'metaTitle' => 'Basic English words',
                'slug' => Str::slug('Beginner Vocabulary'),
                'content' => 'Simple words for English beginners.',
                'parentId' => null,
                'created_at' => Carbon::now(),
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
