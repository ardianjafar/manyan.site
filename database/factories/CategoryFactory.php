<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        return [
            'parentId' => null,
            'title' => ucfirst($name),
            'metaTitle' => ucfirst($name),
            'slug' => Str::slug($name),
            'content' => $this->faker->sentence(8),
            'created_at' => Carbon::now(),

        ];
    }
}
