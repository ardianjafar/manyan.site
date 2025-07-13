<?php

namespace Database\Seeders;

use App\Models\EducationalWord;
use Illuminate\Database\Seeder;

class EducationalSeeder extends Seeder
{
    public function run(): void
    {
        EducationalWord::factory()->count(15)->create();
    }
}