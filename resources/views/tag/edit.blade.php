@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Edit Tag</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tags.update', $tags->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Tag Title</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title', $tags->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="metatitle" class="form-label fw-bold">Meta Title (SEO)</label>
            <input type="text" name="metaTitle" id="metaTitle" class="form-control mb-3" value="{{ old('metaTitle', $tags->metaTitle) }}">
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label fw-bold">Slug (URL)</label>
            <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug', $tags->slug) }}">
        </div>


        <div class="d-flex">
            <button type="submit" class="btn btn-primary me-2">Update Tags</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary ml-2">Back</a>
        </div>

    </form>
</div>
@endsection
