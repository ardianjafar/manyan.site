<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Manyan | Blog</title>

    <!-- Custom fonts for this template -->
    <link href="{{  asset('assets/admins/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/admins/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/admins/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    {{-- Css for filter --}}
    <!-- Bootstrap 5 CSS -->
    {{-- Belum ada, itu carikan --}}

    <!-- Select CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Flatpicker CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Filepond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

       @include('admin.layouts.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('admin.layouts.topbar')
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('admin.layouts.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Modal Profile -->
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Profile</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>Name  : {{ Auth::user()->name }}</li>
                        <li>Email : {{ Auth::user()->email }}</li>
                        <li>Surname : {{ Auth::user()->lastName }}</li>
                    </ul>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Update Profile -->
    <div class="modal fade" id="update_profile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Your Profile</h5>

                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="firstName" class="form-label fw-bold">First Name</label>
                                <input type="text" name="firstName" id="firstName" class="form-control mb-3" value="{{ old('firstName', Auth::user()->firstName) }}">
                            </div>
                            <div class="mb-3">
                                <label for="middleName" class="form-label fw-bold">Middle Name</label>
                                <input type="text" name="middleName" id="middleName" class="form-control mb-3" value="{{ old('middleName', Auth::user()->middleName) }}">
                            </div>
                            <div class="mb-3">
                                <label for="lastName" class="form-label fw-bold">Last Name</label>
                                <input type="text" name="lastName" id="lastName" class="form-control mb-3" value="{{ old('lastName', Auth::user()->lastName) }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email </label>
                                <input type="text" name="email" id="email" class="form-control mb-3" value="{{ old('email', Auth::user()->email) }}">
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label fw-bold">Update Password</label>
                                    <input type="password" name="password" id="password" class="form-control" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="">
                                </div>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <button class="btn btn-primary" type="button" data-dismiss="modal">Save</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</body data-page="{{ $page }}">
    {{-- Bootstrap for filter --}}
    <!-- Bootstrap 5 JS (Popper.js included) -->
    {{-- Belum ada untuk itu carikan  --}}
    
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/admins/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/admins/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- Select JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Sweetalert CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Flatpicker CSS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- FilePond CSS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/admins/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/admins/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('assets/admins/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/admins/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admins/js/demo/datatables-demo.js') }}"></script>

    @yield('script')
    @include('admin.layouts.script')
</body>

</html>