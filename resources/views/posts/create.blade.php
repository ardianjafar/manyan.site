@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Create New Post</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Post Title</label>
            <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title') }}">
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
            <label for="content" class="form-label fw-bold">Post Content</label>
            <textarea name="content" id="editor" class="form-control mb-3" rows="10">{{ old('content') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="summary" class="form-label fw-bold">Post Summary</label>
            <textarea name="summary" id="editor" class="form-control mb-3" rows="3">{{ old('summary') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="categories" class="form-label fw-bold">Select Categories</label>
            <select name="categories[]" id="categories" class="form-control js-example-basic-multiple" multiple placeholder="Select Categories">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ (collect(old('categories', isset($post) ? $post->categories->pluck('id') : []))->contains($category->id)) ? 'selected' : '' }}
                        {{ $category->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="publishedAt" class="form-label fw-bold">Publish Date (Optional)</label>
                <input type="date" name="publishedAt" id="published" class="form-control mb-3" value="{{ old('publishedAt') }}">
            </div>
    
            <div class="col-md-6 mb-3">
                <label for="published" class="form-label fw-bold">Post Status</label>
                <select name="published" id="published" class="form-control">
                    <option value="1" {{ old('published') == '1' ? 'selected' : '' }}>Published</option>
                    <option value="0" {{ old('published') == '0' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label fw-bold">Post Image (Optional)</label>
            <div class="input-group">
                <input type="text" name="image" id="thumbnail" class="filepond form-control mb-3">
                <span class="input-group-btn">
                    <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                        <i class="fa fa-picture-o"></i> Choose
                    </button>
                </span>
                <img id="holder" style="margin-top:15px;max-height:100px;">
            </div>
        <div class="mt-5">

            <button type="submit" class="btn btn-primary">Publish</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
