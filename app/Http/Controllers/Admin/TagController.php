<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;

class TagController extends Controller
{
    public function index()
    {
        $items = Tag::latest()->paginate(20);
        return view('admin.tag', compact('items'), ['page' => 'tags']);
    }

    public function create()
    {
        return view('tag.create', ['page' => 'tags']);
    }

    public function store(StoreTagRequest $request)
    {
        $request->validated();
        Tag::create($request->only(['title', 'metaTitle', 'slug']));
        return redirect()->route('tags.index')->with('success', 'Tag added!');
    }

    public function edit($id)
    {
        $tags = Tag::findOrFail($id);
        return view('tag.edit', compact('tags'), ['page' => 'tags']);
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $item = Tag::findOrFail($id);
        $request->validated();
        $item->update($request->only(['title', 'metaTitle', 'slug']));
        return redirect()->route('tags.index')->with('success', 'Tag updated!');
    }

    public function destroy($id)
    {
        $item = Tag::findOrFail($id);
        $item->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted!');
    }

    // Opsional: bulk delete jika diperlukan
    public function bulkDelete(Request $request)
    {
        $ids = explode(',', $request->bulk_tags);

        if (count($ids) <= 1) {
            return redirect()->route('tags.index')->with('error', 'Please select more than one tag.');
        }

        Tag::whereIn('id', $ids)->delete();

        return redirect()->route('tags.index')->with('success', 'Selected tags deleted successfully.');
    }
}
