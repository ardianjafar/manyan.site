@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Category</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">categorie Title</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title', $category->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="metatitle" class="form-label fw-bold">Meta Title (SEO)</label>
            <input type="text" name="metaTitle" id="metaTitle" class="form-control mb-3" value="{{ old('metaTitle', $category->metaTitle) }}">
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label fw-bold">Slug (URL)</label>
            <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug', $category->slug) }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label fw-bold">category Content</label>
            <textarea name="content" id="content" class="form-control mb-3" rows="6" required>{{ old('content', $category->content) }}</textarea>
        </div>

        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-2">Update category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">Back</a>
        </div>

    </form>
</div>
@endsection
