<?php 
namespace Database\Factories;

use App\Models\Chinese;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChineseFactory extends Factory
{
    protected $model = Chinese::class;

    public function definition(): array
    {
        $types = ['noun', 'verb', 'adverb','conjunction','preposition','measure','particle','determiner'];
        $levels = ['beginner', 'intermediate', 'advanced'];

        return [
            'hanzi' => $this->faker->randomElement(['你', '是', '来', '我']),
            'pinyin' => $this->faker->randomElement(['nǐ', 'shì', 'lái', 'wǒ']),
            'meaning' => $this->faker->randomElement(['you', 'to be', 'to come', 'I']),
            'type' => $this->faker->randomElement($types),
            'example_cn' => '你好嗎？',
            'example_id' => 'Apa kabar?',
            'level' => $this->faker->randomElement($levels),
        ];
    }
}
