<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EducationalWord;
use App\Models\Category;



class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EducationalWord::query();
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan level jika ada
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Urutkan berdasarkan kata jika ada parameter sort
        if ($request->filled('sort')) {
            $query->orderBy('word_en', $request->sort);
        }

        // Untuk dropdown
        $levels = EducationalWord::select('level')->distinct()->pluck('level');
        $categories = Category::all();
        
        $words = EducationalWord::latest()->paginate(10);
        return view('admin.education', compact('words','levels', 'categories'), ['page' => 'educations']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('education.create', compact('categories'),['page' => 'educations']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
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
    public function edit($id)
    {
        $categories = Category::all();
        $words = EducationalWord::findOrFail($id);
        return view('education.edit', compact('words','categories'), ['page' => 'words']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'category_id'   => 'required|exists:categories,id',
            'word_en'       => 'required|string|max:255',
            'word_id'       => 'required|string|max:255',
            'type'          => 'required|in:noun,verb,adjective,adverb', // disesuaikan dengan enum type
            'example_en'    => 'nullable|string',
            'example_id'    => 'nullable|string',
            'level'         => 'required|in:beginner,intermediate,advanced', // disesuaikan dengan enum level
        ]);

        // Cari data berdasarkan ID
        $word = EducationalWord::findOrFail($id);

        // Update data
        $word->update($validated);

        return redirect()->route('educational-words.index')->with('success', 'Word updated successfully!');
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
