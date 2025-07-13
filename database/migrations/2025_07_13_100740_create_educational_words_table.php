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
        Schema::create('educational_words', function (Blueprint $table) {
            $table->id();
            $table->string('word_en');
            $table->string('word_id');
            $table->enum('type', ['noun', 'verb', 'adjective', 'adverb']);
            $table->text('example_en')->nullable();
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
        Schema::dropIfExists('educational_words');
    }
};
