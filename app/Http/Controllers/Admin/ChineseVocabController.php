<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chinesevocab;
use Illuminate\Http\Request;
use App\Http\Requests\StoreChinesevocabRequest;
use App\Http\Requests\UpdateChinesevocabRequest;

class ChineseVocabController extends Controller
{
    public function index()
    {
        $items = Chinesevocab::latest()->paginate(20);
        return view('admin.educhn', compact('items'), ['page' => 'chinese']);
    }

    public function create()
    {
        return view('educhn.create', ['page' => 'chinese']);
    }

    public function store(StoreChinesevocabRequest $request)
    {
        $request->validated();

        Chinesevocab::create($request->all());
        return redirect()->route('vocabs-chn.index')->with('success', 'Vocabulary added!');
    }

    public function edit($id)
    {
        $item = Chinesevocab::findOrFail($id);
        return view('educhn.edit', compact('item'), ['page' => 'chinese']);
    }

    public function update(UpdateChinesevocabRequest $request, $id)
    {
        $item = Chinesevocab::findOrFail($id);

        $request->validated();

        $item->update($request->all());
        return redirect()->route('vocabs-chn.index')->with('success', 'Vocabulary updated!');
    }

    public function destroy($id)
    {
        $item = Chinesevocab::findOrFail($id);
        $item->delete();
        return redirect()->route('vocabs-chn.index')->with('success', 'Vocabulary deleted!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->educational_chn);  // Tetap gunakan 'post_ids'

        if (count($ids) <= 1) {
            return redirect()->route('vocabs-chn.index')->with('error', 'Please select more than one post.');
        }

        Chinesevocab::whereIn('id', $ids)->delete();

        return redirect()->route('vocabs-chn.index')->with('success', 'Selected posts deleted successfully.');
    }
}
