<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationalWordFactory extends Factory
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
            'word_en'    => $pair[0],
            'word_id'    => $pair[1],
            'type'       => fake()->randomElement(['noun', 'verb', 'adjective', 'adverb']), // ✅ sesuai enum
            'example_en' => fake()->sentence(),
            'example_id' => fake()->sentence(),
            'level'      => fake()->randomElement(['beginner', 'intermediate', 'advanced']), // ✅ sesuai enum
        ];
    }
}
