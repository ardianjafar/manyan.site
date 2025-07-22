@extends('admin.layouts.app')

@section('title', 'Halaman Chinese')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Halaman Tag</h1>
<p class="mb-4">Ini adalah tampilan dari halaman Tag</a>.</p>

<!-- DataTales Example -->
<!-- Filter Bar -->
<form method="GET" action="{{ route('tags.index') }}" class="mb-4">
    <div class="row align-items-end gx-2">
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="🔍 Search word or example..." value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="category_id" class="form-select" onchange="this.form.submit()">
                <option value="">-- Filter by Category --</option>
                
            </select>
        </div>

        <div class="col-md-2">
            <select name="level" class="form-select" onchange="this.form.submit()">
                <option value="">-- Filter by Level --</option>
                
            </select>
        </div>

        <div class="col-md-2">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <option value="">-- Sort by Word --</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A - Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z - A</option>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-center">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="all" id="showAll" value="1" onchange="this.form.submit()" {{ request('all') ? 'checked' : '' }}>
                <label for="showAll" class="form-check-label">Tampilkan Semua</label>
            </div>
        </div>
    </div>
</form>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('tags.create') }}" class="btn btn-primary btn-sm">+ Add Tag</a>
        <form id="bulk-delete-form" method="POST" action="{{ route('tags.bulk-delete') }}" class="d-inline">
            @csrf
            <input type="hidden" name="bulk_tags" id="bulk-tags">
            <button type="submit" id="bulk-delete-btn" class="btn btn-danger btn-sm" style="display: none;">Delete Selected</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all" />
                        </th>
                        <th>Title</th>
                        <th>Meta Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td>
                            <input type="checkbox" name="selected_education[]" value="{{ $item->id }}" class="tags-checkbox">
                        </td>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->metaTitle }}</td>
                        <td class="d-flex">
                            <a href="{{ route('tags.edit', $item->id) }}" class="btn btn-primary btn-sm mx-1">Edit</a>
                            <form action="{{ route('tags.destroy', $item->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>
    </div>
</div>

<!-- /.container-fluid -->

<!-- End of Content Wrapper -->
@endsection

@section('script')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteForms = document.querySelectorAll('.delete-form');

    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Stop form submit

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success Created!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
@endif

@if(session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Success Edited!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        });
    </script>
@endif
@endsection