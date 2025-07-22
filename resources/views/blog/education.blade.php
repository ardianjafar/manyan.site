@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="mt-2">
        <div class="card shadow rounded">
            <div class="card-body">
                <h3 class="card-title text-center fw-bold mb-2">📘 Vocabulary Table</h3>
                {{-- Search and Filter --}}
                <div class="row mb-2">
                    <div class="row mb-3 align-items-end">
                        <div class="col-md-6 mb-1 mt-1">
                            <input type="text" name="search" value="" class="form-control" placeholder="🔍 Search word or example...">
                        </div>
                        <div class="col-md-6 mb-1 mt-1">
                            <a href="{{ route('posts.export.pdf', request()->query()) }}" class="btn btn-danger btn-sm w-100">
                                <i class="fas fa-file-pdf"></i> Export PDF
                            </a>
                        </div>
                    </div>
                    <div class="d-inline">
                        <form method="GET" action="{{ route('blog.education') }}" class="row g-2 mb-3">
                            <div class="col-md-3">
                                <select name="category_id" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Filter by Category --</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="level" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Filter by Level --</option>
                                    @foreach ($levels as $lvl)
                                        <option value="{{ $lvl }}" {{ request('level') == $lvl ? 'selected' : '' }}>
                                            {{ ucfirst($lvl) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="">-- Sort by Word --</option>
                                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A - Z</option>
                                    <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z - A</option>
                                </select>
                            </div>

                            <div class="col-md-3 d-flex align-items-center">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="all" value="1" id="showAll"
                                        onchange="this.form.submit()" {{ request('all') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="showAll">Tampilkan Semua</label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
    
                {{-- Table --}}
                <div class="table-responsive">
                    <p class="text-muted">Showing {{ $words->count() }} result{{ $words->count() > 1 ? 's' : '' }}.</p>
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
            </div>
        </div>
        <div class="mb-5">
            @if ($words->hasPages())
                <nav class="d-flex justify-content-center mt-5">
                    <ul class="pagination pagination-rounded mb-0">
                        {{-- Previous Page Link --}}
                        @if ($words->onFirstPage())
                            <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $words->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Number Links --}}
                        @php
                            $currentPage = $words->currentPage();
                            $lastPage = $words->lastPage();
                            $start = max(1, $currentPage - 2);
                            $end = min($lastPage, $currentPage + 2);
                        @endphp

                        {{-- Show first page --}}
                        @if ($start > 1)
                            <li class="page-item"><a class="page-link" href="{{ $words->url(1) }}">1</a></li>
                            @if ($start > 2)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                        @endif

                        {{-- Main pagination loop --}}
                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $currentPage)
                                <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $words->url($i) }}">{{ $i }}</a></li>
                            @endif
                        @endfor

                        {{-- Show last page --}}
                        @if ($end < $lastPage)
                            @if ($end < $lastPage - 1)
                                <li class="page-item disabled"><span class="page-link">...</span></li>
                            @endif
                            <li class="page-item"><a class="page-link" href="{{ $words->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif

                        {{-- Next Page Link --}}
                        @if ($words->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $words->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

@endsection
