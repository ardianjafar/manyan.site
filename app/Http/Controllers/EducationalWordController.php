<?php

namespace App\Http\Controllers;

use App\Models\EducationalWord;
use Illuminate\Http\Request;


class EducationalWordController extends Controller
{
    // GET /api/educational-words
    public function index()
    {
        return EducationalWord::all();;
    }

    // GET /api/educational-words/{id}
    public function show($id)
    {
        $word = EducationalWord::find($id);
        if (!$word) {
            return response()->json(['message' => 'Word not found'], 404);
        }
        return $word;
    }

    // POST /api/educational-words
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'word_en' => 'required|string|max:255',
            'word_id' => 'required|string|max:255',
            'type' => 'required|in:noun,verb,adjective,adverb',
            'example_en' => 'nullable|string',
            'example_id' => 'nullable|string',
            'level' => 'nullable|in:beginner,intermediate,advanced',
        ]);

        $word = EducationalWord::create($validated);
        return response()->json($word, 201);
    }
}
