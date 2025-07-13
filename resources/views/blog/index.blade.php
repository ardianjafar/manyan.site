@extends('layouts.app')
    
@section('content')
	<div class="main-wrapper">
	    <section class="cta-section theme-bg-light py-5">
		    <div class="container text-center single-col-max-width">
			    <h2 class="heading">Welcome to Manyan Blog - 你好</h2>
			    <div class="intro">我叫 阿迪安，來自印度尼西亞，歡迎來到我的博客</div>
			    <div class="single-form-max-width pt-3 mx-auto">
				    <form class="signup-form row g-2 g-lg-2 align-items-center">
	                    <div class="col-12 col-md-9">
	                        <label class="sr-only" for="semail">Your email</label>
	                        <input type="email" id="semail" name="semail1" class="form-control me-md-1 semail" placeholder="Enter email">
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
				@foreach ($posts as $post)
					<div class="item mb-5">
						<div class="row g-3 g-xl-0">
							<div class="col-2 col-xl-3">
								{{-- <img class="img-fluid post-thumb " src="{{ asset('assets/images/manyan2.png') }}" alt="image"> --}}
								<img src="{{ Str::startsWith($post->image, ['http://', 'https://']) ? $post->image : asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="img-fluid rounded">
							</div>
							<div class="col mx-2">
								<h3 class="title mb-1"><a class="text-link" href="{{  route('blog.show', $post->id) }}">{{ $post->title }} </a></h3>
								<div class="meta mb-1"><span class="date">Published {{ $post->publishedAt ? $post->publishedAt->diffForHumans() : 'N/A' }}</span><span class="time">5 min read</span><span class="comment"><a class="text-link" href="#">8 comments</a></span></div>
								<div class="intro">{{ Str::limit($post->content, 120) }}</div>
								<a class="text-link" href="{{  route('blog.show', $post->id) }}">Read more &rarr;</a>
							</div><!--//col-->
						</div><!--//row-->
					</div><!--//item-->
				@endforeach
			    
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
    
    
    