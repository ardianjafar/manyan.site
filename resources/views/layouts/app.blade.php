<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Home - Welcome Page</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Blog Template">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}"> 
    
    <!-- FontAwesome JS-->
	<script defer src="{{ asset('assets/fontawesome/js/all.min.js')}}"></script>
    
    <!-- Theme CSS -->  
    <link id="theme-style" rel="stylesheet" href="{{ asset('assets/css/theme-1.css')}}">

</head> 

<body>
    @include('layouts.navigation')
    @yield('content')
    @include('layouts.footer')

    <!-- Javascript -->          
    <script src="{{ asset('assets/plugins/popper.min.js')}}"></script> 
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}"></script> 
    <!-- Javascript -->          
    <script src="assets/plugins/popper.min.js"></script> 
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script> 

    <!-- Page Specific JS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.5.1/highlight.min.js"></script>

    <!-- Custom JS -->
    <script src="assets/js/blog.js"></script> 

    @include('layouts.script')
</body>
</html> 