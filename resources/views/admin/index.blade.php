@extends('admin.layouts.app')

@section('title', 'Halaman Home')

@section('content')

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Halaman Blog</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">+ Add Post</a>
                        <form id="bulk-delete-form" method="POST" action="{{ route('posts.bulk-delete') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="post_ids" id="bulk-post-ids">
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
                                        <th>Summary</th>
                                        <th>Published At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="selected_posts[]" value="{{ $post->id }}" class="post-checkbox">
                                            
                                        </td>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->summary }}</td>
                                        <td>{{ $post->publishedAt }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-warning btn-sm mx-1">Detail</a>
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm mx-1">Edit</a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline delete-form">
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