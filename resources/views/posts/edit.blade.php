@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">

    
    <nav aria-label="breadcrumb">
        <h2 class="mb-2">Edit Post</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        </ol>
    </nav>


    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card shadow rounded">
        <div class="card-body">
            <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="title" class="form-label fw-bold">Post Title</label>
                        <input type="text" name="title" id="title" class="form-control mb-3" value="{{ old('title', $post->title) }}" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="slug" class="form-label fw-bold">Slug (URL)</label>
                        <input type="text" name="slug" id="slug" class="form-control mb-3" value="{{ old('slug', $post->slug) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="metatitle" class="form-label fw-bold">Meta Title (SEO)</label>
                    <input type="text" name="metaTitle" id="metaTitle" class="form-control mb-3" value="{{ old('metaTitle', $post->metaTitle) }}">
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label fw-bold">Post Content</label>
                    <textarea name="content" id="editor" class="form-control mb-3" rows="6" 
                        required>{{ old('content', isset($post->content) ? str_replace(['<br>', '<br/>', '<br />', '</p>'], "\n", $post->content) : '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="summary" class="form-label fw-bold">Post Summary</label>
                    <textarea name="summary" id="summary" class="form-control mb-3" rows="3">{{ old('summary', $post->summary) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="categories" class="form-label fw-bold">Select Categories</label>
                        <select name="categories[]" id="categories" class="form-control" multiple>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ in_array($category->id, $postCategories) ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="tags" class="form-label fw-bold">Select Tags</label>
                        <select name="tags[]" id="tags" class="form-control" multiple>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" 
                                    {{ in_array($tag->id, $postCategories) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="published" class="form-label fw-bold">Post Status</label>
                        <select name="published" id="published" class="form-control">
                            <option value="1" {{ old('published', $post->published) == '1' ? 'selected' : '' }}>Published</option>
                            <option value="0" {{ old('published', $post->published) == '0' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Post Image (Optional)</label>

                    <input type="text" name="image" id="thumbnail" class="filepond form-control mb-3" value="{{ old('image', $post->image) }}">
                    <span class="input-group-btn">
                        <button id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </button>
                    </span>

                    <img id="holder" style="margin-top:15px;max-height:100px;">

                    @if(isset($post) && $post->image)
                        <div class="mt-2">
                            <small>Current Image:</small><br>
                            <img 
                                src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('public/uploads/' . $post->image) }}" 
                                alt="Post Image" 
                                style="max-width: 200px; border-radius: 4px;"
                            >
                        </div>
                    @endif
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn btn-primary me-2">Update Post</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary ml-2">Back</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
