<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EducationalWord;
use App\Models\Category;

class VocabularyTable extends Component
{
    use WithPagination;

    public $search = '';
    public $category_id = '';
    public $level = '';
    public $sort = '';
    public $showAll = false;

    protected $updatesQueryString = ['search', 'category_id', 'level', 'sort', 'showAll'];

    public function updating($property)
    {
        // Reset pagination saat filter berubah
        $this->resetPage();
    }

    public function render()
    {
        $query = EducationalWord::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('word_en', 'like', "%{$this->search}%")
                  ->orWhere('word_id', 'like', "%{$this->search}%")
                  ->orWhere('type', 'like', "%{$this->search}%")
                  ->orWhere('example_en', 'like', "%{$this->search}%")
                  ->orWhere('example_id', 'like', "%{$this->search}%");
            });
        }

        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        if ($this->level) {
            $query->where('level', $this->level);
        }

        if ($this->sort) {
            $query->orderBy('word_en', $this->sort);
        }

        $words = $this->showAll ? $query->limit(200)->get() : $query->paginate(10);

        return view('livewire.vocabulary-table', [
            'words' => $words,
            'categories' => Category::all(),
            'levels' => EducationalWord::select('level')->distinct()->pluck('level'),
        ]);
    }
}
