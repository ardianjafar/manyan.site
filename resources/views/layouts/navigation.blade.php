<header class="header text-center">	    
	    <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="index.html">Manyan's Blog</a></h1>
        
	    <nav class="navbar navbar-expand-lg navbar-dark" >
           
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div id="navigation" class="collapse navbar-collapse flex-column" >
				<div class="profile-section pt-3 pt-lg-0">
				    <img class="profile-image mb-3 rounded-circle mx-auto" src="{{ asset('assets/images/manyan.png')}}" alt="image" >			
					
					<div class="bio mb-3">Hi, You can call me Manyan. In this site I will share about my Experience and study Language also Travelling.<br><a href="{{ route('about-me') }}">Find out more about me</a></div><!--//bio-->
					<ul class="social-list list-inline py-3 mx-auto">
			            <li class="list-inline-item"><a href="https://instagram.com/ardianjafar_46"><i class="fa-brands fa-instagram fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="https://linkedin.com/in/ardiajafar"><i class="fa-brands fa-linkedin-in fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="https://github.com/ardianjafar"><i class="fa-brands fa-github-alt fa-fw"></i></a></li>
			            <li class="list-inline-item"><a href="#"><i class="fa-brands fa-whatsapp fa-fw"></i></a></li>
			        </ul><!--//social-list-->
			        <hr> 
				</div><!--//profile-section-->
				
				<ul class="navbar-nav flex-column text-start">
					<li class="nav-item">
					    <a class="nav-link active" href="{{ route('home')}}"><i class="fas fa-home fa-fw me-2"></i>Blog Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" href="#"><i class="fas fa-bookmark fa-fw me-2"></i>Blog Post</a>
					</li>
					<li class="nav-item">
					    <a class="nav-link" href="{{ route('about-me') }}"><i class="fas fa-user fa-fw me-2"></i>About Me</a>
					</li>
				</ul>
				
				<div class="my-2 my-md-3">
				    <a class="btn btn-primary" href="https://drive.google.com/file/d/1qzAQp21w7CntP86xnpxh7asAn_IrMJtX/view?usp=sharing" target="_blank">Download CV</a>
				</div>
			</div>
		</nav>
    </header>