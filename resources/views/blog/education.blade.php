'@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="container mt-2">
        <div class="card shadow rounded">
            <div class="card-body">
                <h3 class="card-title text-center fw-bold mb-2">📘 Vocabulary Table</h3>
                {{-- Search and Filter --}}
                <div class="row mb-2">
                    <div class="col-md-6">
                        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Search word or example...">
                    </div>
                    <div class="col-md-3">
                        <select id="sortSelect" class="form-select">
                            <option value="">🔃 Sort By Word</option>
                            <option value="asc">A - Z</option>
                            <option value="desc">Z - A</option>
                        </select>
                    </div>
                    <form method="GET" action="{{ route('blog.education') }}" class="row g-2 mb-2">
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
                    </form>
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
                            <li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $words->previousPageUrl() }}" rel="prev">&laquo;</a>
                            </li>
                        @endif
    
                        {{-- Pagination Links (Auto-generated) --}}
                        @foreach ($words->getUrlRange(1, $words->lastPage()) as $page => $url)
                            @if ($page == $words->currentPage())
                                <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
    
                        {{-- Next Page Link --}}
                        @if ($words->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $words->nextPageUrl() }}" rel="next">&raquo;</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>
    </div>
</div>

@endsection
