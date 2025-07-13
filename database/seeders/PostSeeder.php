<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if(!$user){
            $user = User::factory()->create([
                'firstName' => 'Allan',
                'middleName' => 'Manyan',
                'lastName' => 'Bogan',
                'email' => 'schroeder.london@example.net',
                'passwordHash' => bcrypt('password'),   
            ]);
        }

        for($i =1; $i <= 10; $i++){
            $title = fake()->sentence(6);
            Post::create([
                'authorId' => $user->id,
                'parentId' => null,
                'title' => $title,
                'metaTitle'    => fake()->sentence(3),
                'slug' => Str::slug($title),
                'image'=> null,
                'summary' => fake()->sentence(10),
                'published' => true,
                'content' => fake()->paragraph(5),
                'publishedAt' => now() 
            ]);
        }
    }
}
