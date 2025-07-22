<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>@yield('title', config('app.name'))</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(!empty($metaTitle))
        <meta name="metaTitle" content="{{ $metaTitle }}">
    @endif
    @if(!empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    
    <meta name="author" content="Manyan-Blog">    
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}"> 
    
    <!-- CSS custome-->
    <link rel="stylesheet" href="{{ asset('assets/css/front.css')}}">
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/theme-1.css')}}">
</head> 

<body>
    @include('layouts.navigation')
    @yield('content')
    @include('layouts.footer')


    <!-- FontAwesome JS-->
	<script defer src="{{ asset('assets/fontawesome/js/all.min.js')}}"></script>

    <!-- Javascript -->          
    <script src="{{ asset('assets/plugins/popper.min.js')}}"></script> 
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> 

    <!-- Page Specific JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>
    <!-- Harus ada ini (versi Bootstrap 5 ke atas) -->


    <!-- Custom JS -->
    <script src="{{ asset('assets/js/blog.js')}}"></script> 

    @include('layouts.script')
</body>
</html> 