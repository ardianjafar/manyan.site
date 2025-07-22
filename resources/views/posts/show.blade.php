@extends('admin.layouts.app')

@section('content')
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        </ol>
    </nav>

    <div class="card shadow rounded">
        <div class="card-body">
            <h2 class="mb-2">{{ $post->title }}</h2>

            <p class="text-muted mb-2">
                By {{ $post->author->name ?? 'Anonymous' }} | {{ $post->publishedAt ? $post->publishedAt->format('d-m-Y') : 'No Date' }}
            </p>

            @if($post->image)
                <div class="text-center my-4">
                    <img src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" alt="Post Image" class="img-fluid rounded shadow-sm" width="50%" height="50%">
                </div>
            @endif

            <div class="mb-4 post-content" style="line-height: 1.8; font-size: 1rem;">
                <h5>Meta Title</h5>
                {!! ($post->metaTitle) !!}
            </div>
            <div class="mb-4 post-content" style="line-height: 1.8; font-size: 1rem;">
                <h5>Post Summary</h5>
                {!! ($post->summary) !!}
            </div>
            <div class="mb-4 post-content" style="line-height: 1.8; font-size: 1rem;">
                <h5>Post Content</h5>
                <p>
                    {!! ($post->content) !!}
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <strong>Categories:</strong>
                    @forelse($post->categories as $category)
                        <span class="badge bg-danger text-white">{{ $category->title }}</span>
                    @empty
                        <span class="text-muted">No Categories</span>
                    @endforelse
                </div>
                <div class="col-md-4 mb-3">
                    <strong>Tag:</strong>
                    @forelse($post->tags as $tag)
                        <span class="badge bg-danger text-white">{{ $tag->name }}</span>
                    @empty
                        <span class="text-muted">No Tag</span>
                    @endforelse
                </div>

                <div class="col-md-4 d-flex align-items-center gap-2 ">
                    <strong>Status:</strong>
                    <span class="badge {{ $post->published ? 'bg-success' : 'bg-secondary' }}">
                        {{ $post->published ? ' Published' : ' Draft' }}
                    </span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                    &larr; Back to Blog
                </a>
            </div>
        </div>
    </div>
</div>
@endsection