@extends('layouts.app')

@section('content')
    
    <div class="main-wrapper">
	    
	    <article class="blog-post px-3 py-5 p-md-5">
		    <div class="container single-col-max-width">
			    <div class="blog-post-body pb-3">
				    <figure class="blog-banner">
							<img src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
					</figure>

					<header class="blog-post-header">
						<h2 class="title mb-2">{{ $post->title }}</h2>
						<div class="meta mb-3">
							<span class="date">Published {{ $post->publishedAt ? $post->publishedAt->diffForHumans() : 'N/A' }}</span>
							<span class="time">{{ $post->readingTime() }} min read</span><span class="comment">
							<a  class="text-link" href="#">4 comments</a></span></div>
					</header>

					<div class="my-3 border-top border-bottom py-2 d-flex align-items-center flex-wrap">
						<span class="me-2 fw-bold">Share:</span>
						<a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" class="btn btn-outline-success btn-sm me-2 mb-2 px-3 py-1 rounded-pill d-flex align-items-center">
							<i class="fab fa-facebook-f me-1"></i> Facebook
						</a>
						<a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}" class="btn btn-outline-warning btn-sm me-2 mb-2 px-3 py-1 rounded-pill d-flex align-items-center">
							<i class="fab fa-twitter me-1"></i> Twitter
						</a>
						<a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" class="btn btn-outline-info btn-sm me-2 mb-2 px-3 py-1 rounded-pill d-flex align-items-center">
							<i class="fab fa-linkedin-in me-1"></i> Linkedin
						</a>
						<a href="mailto:?subject={{ urlencode($post->title) }}&body={{ urlencode(request()->fullUrl()) }}" class="btn btn-outline-danger btn-sm mb-2 px-3 py-1 rounded-pill d-flex align-items-center">
							<i class="fas fa-envelope me-1"></i> Email
						</a>
					</div>
					<div class="content">
						 {!! $post->content !!}
					</div>
				    
					<h5 class="mb-3">Category Posts</h5>
					@forelse($post->categories as $category)
						<span class="badge bg-secondary">{{ $category->title }}</span>
					@empty
						<span class="text-muted">No Category</span>
					@endforelse
					{{-- {{ dd($post) }} --}}
			    </div>
				
				<!-- Related Posts Section -->
				<div class="border-top pt-4 mt-5">
				<h5 class="mb-4">Related Posts</h5>
				<div class="row">
					@forelse($relatedPosts as $related)
					<div class="col-md-4 mb-3">
						<div class="card h-100 shadow-sm border-0">
						<img src="{{ Str::startsWith($related->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $related->image) }}" class="card-img-top" alt="{{ $related->title }}">
						<div class="card-body">
							<h6 class="card-title fw-semibold">{{ Str::limit($related->title, 60) }}</h6>
							<p class="card-text small text-muted">
							{{ Str::limit(strip_tags($related->content), 90) }}
							</p>
							<a href="{{ route('blog.show', $related->slug) }}" class="text-success small fw-bold">Read More</a>
						</div>
						</div>
					</div>
					@empty
					<p class="text-muted">No related posts found.</p>
					@endforelse
				</div>
				</div>

		    </div><!--//container-->
	    </article>
		
    </div><!--//main-wrapper-->

@endsection
