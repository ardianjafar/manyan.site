@extends('admin.layouts.app')

@section('title', 'Halaman Home')

@section('content')

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Halaman Category</h1>
                <p class="mb-4">Ini adalah tampilan dari halaman Category</a>.</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">+ Add Category</a>
                        <form id="bulk-delete-form" method="POST" action="{{ route('categories.bulk-delete') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="category_ids" id="bulk-category-ids">
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
                                        <th>MetaTitle</th>
                                        <th>Published At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_categories[]" value="{{ $category->id }}" class="category-checkbox">
                                        </td>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->metaTitle }}</td>
                                        <td>{!! Str::limit($category->content,120) !!}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning btn-sm mx-1">Detail</a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm mx-1">Edit</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form">
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