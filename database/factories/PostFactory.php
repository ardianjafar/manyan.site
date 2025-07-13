<?php 

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'authorId' => 1,
            'parentId' => null,
            'title' => $this->faker->sentence(3),
            'metatitle' => $this->faker->sentence(4),
            'slug' => Str::slug($this->faker->sentence(3) . '-' . $this->faker->unique()->numberBetween(1, 1000)),
            'image' => $this->faker->imageUrl(640, 480),
            'summary' => $this->faker->text(100),
            'published' => $this->faker->boolean,
            'content' => $this->faker->paragraphs(3, true),
            'publishedAt' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
