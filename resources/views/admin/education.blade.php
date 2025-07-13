@extends('admin.layouts.app')

@section('title', 'Halaman Home')

@section('content')

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Halaman Education</h1>
                <p class="mb-4">Ini adalah tampilan dari halaman Edukasi</a>.</p>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('educational-words.create') }}" class="btn btn-primary btn-sm">+ Add Edukasi</a>
                        <form id="bulk-delete-form" method="POST" action="" class="d-inline">
                            @csrf
                            <input type="hidden" name="category_ids" id="bulk-category-input">
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
                                        <th>Word En</th>
                                        <th>Word Id</th>
                                        <th>Type</th>
                                        <th>Example En</th>
                                        <th>Example Id</th>
                                        <th>Level</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($words as $word)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_education[]" value="{{ $word->id }}" class="education-checkbox">
                                        </td>
                                        <td>{{ $word->word_en }}</td>
                                        <td>{{ $word->word_id }}</td>
                                        <td>{{ $word->type }}</td>
                                        <td>{{ $word->example_en }}</td>
                                        <td>{{ $word->example_id }}</td>
                                        <td>{{ $word->level }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('educational-words.edit', $word->id) }}" class="btn btn-primary btn-sm mx-1">Edit</a>
                                            <form action="{{ route('educational-words.destroy', $word->id) }}" method="POST" class="d-inline delete-form">
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