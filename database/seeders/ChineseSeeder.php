<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chinese;

class ChineseSeeder extends Seeder
{
    public function run(): void
    {
        Chinese::factory()->count(30)->create();
    }
}
