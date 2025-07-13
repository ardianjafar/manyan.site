<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalWord;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $words = EducationalWord::latest()->paginate(10);
        return view('admin.education', compact('words'), ['page' => 'educations']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('education.create', ['page' => 'educations']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'word_en' => 'required|string',
            'word_id' => 'required|string',
            'type' => 'required|in:noun,verb,adjective,adverb',
            'example_en' => 'nullable|string',
            'example_id' => 'nullable|string',
            'level' => 'nullable|in:beginner,intermediate,advanced',
        ]);

        EducationalWord::create($validated);
        return redirect()->route('educational-words.index')->with('success', 'Kata berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $word = EducationalWord::findOrFail($id);
        $word->delete();

        return redirect()->route('educational-words.index')->with('success', 'Data berhasil dihapus.');
    }
}
