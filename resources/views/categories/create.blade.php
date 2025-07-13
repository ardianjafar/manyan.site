@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Create New Category</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Category Title</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="metaTitle" class="form-label fw-bold">Meta Title (SEO)</label>
            <input type="text" name="metaTitle" id="metaTitle" class="form-control mb-3" value="{{ old('metaTitle') }}">
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label fw-bold">Slug (URL)</label>
            <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug') }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label fw-bold">Category Content</label>
            <textarea name="content" id="editor" class="form-control mb-3" rows="10">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Publish</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@endsection
