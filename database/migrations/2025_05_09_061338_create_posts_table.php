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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('authorId')->constrained('users')->onDelete('cascade');
            $table->foreignId('parentId')->nullable()->constrained('posts')->onDelete('cascade');
            $table->string('title', 75);
            $table->string('metaTitle', 100)->nullable();
            $table->string('slug', 100)->unique();
            $table->string('image')->nullable();
            $table->tinyText('summary')->nullable();
            $table->boolean('published')->default(false);
            $table->text('content')->nullable();
            $table->timestamp('publishedAt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
