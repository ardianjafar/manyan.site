<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vocabularies_mandarin', function (Blueprint $table) {
            $table->id();
            $table->string('hanzi');
            $table->string('pinyin');
            $table->string('meaning');
            $table->enum('type', ['noun','verb','adverb','conjunction','preposition','measure','particle','determiner']);
            $table->text('example_cn')->nullable();
            $table->text('example_id')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocabularies_mandarin');
    }
};
