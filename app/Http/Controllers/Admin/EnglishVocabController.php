<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Englishvocab;
use App\Models\Category;
use App\Http\Requests\StoreEngvocabRequest;
use App\Http\Requests\UpdateEngvocabRequest;

class EnglishVocabController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Englishvocab::query();
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
        $levels = Englishvocab::select('level')->distinct()->pluck('level');
        $categories = Category::all();
        
        $words = Englishvocab::latest()->paginate(10);
        return view('admin.eng-vocab', compact('words','levels', 'categories'), ['page' => 'educations']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('eng-vocab.create', compact('categories'),['page' => 'educations']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEngvocabRequest $request)
    {
        $validated = $request->validated();

        Englishvocab::create($validated);
        return redirect()->route('vocabs.index')->with('success', 'Kata berhasil ditambahkan!');
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
        $words = Englishvocab::findOrFail($id);
        return view('eng-vocab.edit', compact('words','categories'), ['page' => 'words']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEngvocabRequest $request, string $id)
    {
        $validated = $request->validated();

        // Cari data berdasarkan ID
        $word = Englishvocab::findOrFail($id);

        // Update data
        $word->update($validated);

        return redirect()->route('vocabs.index')->with('success', 'Word updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $word = Englishvocab::findOrFail($id);
        $word->delete();

        return redirect()->route('vocabs.index')->with('success', 'Data berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->educational_eng);  // Tetap gunakan 'post_ids'

        if (count($ids) <= 1) {
            return redirect()->route('vocabs.index')->with('error', 'Please select more than one post.');
        }

        EducationalWord::whereIn('id', $ids)->delete();

        return redirect()->route('vocabs.index')->with('success', 'Selected posts deleted successfully.');
    }
}
