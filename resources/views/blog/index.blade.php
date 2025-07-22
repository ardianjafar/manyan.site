@extends('layouts.app')
    
@section('content')
	<div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center single-col-max-width">
			    <h2 class="heading">Welcome to Manyan Blog - 你好</h2>
			    <div class="intro">我叫 阿迪安，來自印度尼西亞，歡迎來到我的博客</div>
			    <div class="single-form-max-width pt-3 mx-auto">
				    <form class="signup-form row g-2 g-lg-2 align-items-center" action="#" method="POST">
						@csrf
	                    <div class="col-12 col-md-9">
	                        <label class="sr-only" for="semail">Your email</label>
	                        <input type="email" id="semail" name="email" class="form-control me-md-1 semail" placeholder="Enter email">
	                    </div>
	                    <div class="col-12 col-md-2">
	                        <button type="submit" class="btn btn-primary">Subscribe</button>
	                    </div>
	                </form><!--//signup-form-->
					<div class="m-2 justify-content-center">
						<a href="{{ route('blog.education')}}" class="text-link">English</a>
						<a href="#" class="text-link">Bahasa</a>
					</div>
				</div><!--//single-form-max-width-->
		    </div><!--//container-->
	    </section>
	    
	    
	    <section class="blog-list px-3 py-5 p-md-5">
		    <div class="container single-col-max-width">
				<div class="row g-4">
					@foreach ($posts as $post)
					@if($post->pinned)
						<span class="badge bg-warning text-dark">Pinned</span>
					@endif
						<div class="card mb-4 shadow-sm border-0" style="border-radius: 18px;">
							@if($post->image)
							<img 
								src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" 
								alt="{{ $post->title }}"
								class="card-img-top"
								style="max-height: 240px; object-fit: cover; border-radius: 18px 18px 0 0;">
							@endif

							<div class="card-body px-4 py-3 d-flex flex-column justify-content-between" style="min-height: 240px;">
								<small class="text-muted d-block mb-2" style="font-size:0.95em;">
									{{ strtoupper(\Carbon\Carbon::parse($post->publishedAt)->format('F d, Y')) }}
								</small>
								<h5 class="card-title fw-bold" style="line-height: 1.3;">
									<a href="{{ route('blog.show', $post->slug) }}" class="text-dark text-decoration-none">{{ $post->title }}</a>
								</h5>
								<p class="card-text text-secondary mt-2 mb-3" style="font-size:1.03em; min-height:60px;">
									{{ Str::limit(strip_tags($post->summary ?? $post->content), 120) }}
								</p>
								<a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-success rounded-pill btn-sm align-self-start px-4">Read more</a>
							</div>
						</div>
						@endforeach
					</div>
				@if ($posts->hasPages())
					<nav class="d-flex justify-content-center mt-5">
						<ul class="pagination pagination-rounded mb-0">
							{{-- Previous Page Link --}}
							@if ($posts->onFirstPage())
								<li class="page-item disabled">
									<span class="page-link">&laquo;</span>
								</li>
							@else
								<li class="page-item">
									<a class="page-link" href="{{ $posts->previousPageUrl() }}" rel="prev">&laquo;</a>
								</li>
							@endif

							{{-- Pagination Links (Auto-generated) --}}
							@foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
								@if ($page == $posts->currentPage())
									<li class="page-item active"><span class="page-link">{{ $page }}</span></li>
								@else
									<li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
								@endif
							@endforeach

							{{-- Next Page Link --}}
							@if ($posts->hasMorePages())
								<li class="page-item">
									<a class="page-link" href="{{ $posts->nextPageUrl() }}" rel="next">&raquo;</a>
								</li>
							@else
								<li class="page-item disabled">
									<span class="page-link">&raquo;</span>
								</li>
							@endif
						</ul>
					</nav>
				@endif
		    </div>
	    </section>
    </div><!--//main-wrapper-->

@endsection
    
    
    