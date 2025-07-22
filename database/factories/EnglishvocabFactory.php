<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EnglishvocabFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $wordPairs = [
            ['run', 'lari'],
            ['eat', 'makan'],
            ['beautiful', 'cantik'],
            ['book', 'buku'],
            ['quickly', 'dengan cepat'],
            ['school', 'sekolah'],
            ['reading', 'membaca'],
        ];

        $pair = fake()->randomElement($wordPairs);

        return [
            'word_en' => $this->faker->unique()->word(),
            'word_id' => $this->faker->word(),
            'type' => $this->faker->randomElement(['noun', 'verb', 'adjective', 'adverb']),
            'example_en' => $this->faker->sentence(),
            'example_id' => $this->faker->sentence(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(), // aman fallback
        ];
    }
}
