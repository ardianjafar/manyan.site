<div>
    <div class="d-flex gap-2 mb-3">
        <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Search word or example...">
        
        <select wire:model="category_id" class="form-select">
            <option value="">-- Filter by Category --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>

        <select wire:model="level" class="form-select">
            <option value="">-- Filter by Level --</option>
            @foreach ($levels as $lvl)
                <option value="{{ $lvl }}">{{ ucfirst($lvl) }}</option>
            @endforeach
        </select>

        <select wire:model="sort" class="form-select">
            <option value="">-- Sort by Word --</option>
            <option value="asc">A-Z</option>
            <option value="desc">Z-A</option>
        </select>

        <div class="form-check align-self-center">
            <input type="checkbox" wire:model="showAll" class="form-check-input" id="showAllCheck">
            <label class="form-check-label" for="showAllCheck">Tampilkan Semua</label>
        </div>
    </div>

    <div>
    <table class="table table-striped table-hover align-middle text-center" id="wordTable">
        <thead class="table-dark">
            <tr class="align-middle" style="transition: all 0.3s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                <th>No</th>
                <th>Word En</th>
                <th>Word Id</th>
                <th>Type</th>
                <th>Example En</th>
                <th>Example Id</th>
                <th>Level</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($words as $word)
                <tr class="align-middle" style="transition: all 0.3s ease;" onmouseover="this.style.background='#f8f9fa'" onmouseout="this.style.background='white'">
                    <td>{{ $loop->iteration }}</td> {{-- ini auto 1, 2, 3, dst --}}
                    <td>{{ $word->word_en }}</td>
                    <td>{{ $word->word_id }}</td>
                        <td><span class="text-success">{{ $word->type }}</span></td>
                    <td>{{ $word->example_en }}</td>
                    <td>{{ $word->example_id }}</td>
                    <td>
                        <span class="badge 
                            {{ $word->level === 'beginner' ? 'bg-success' : ($word->level === 'intermediate' ? 'bg-warning text-dark' : 'bg-danger') }}">
                            {{ $word->level }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    @unless($showAll)
        {{ $words->links() }}
    @endunless
</div>
