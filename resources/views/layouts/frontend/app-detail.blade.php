<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SPK Tempat Makan</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    {{-- <link href="img/favicon.ico" rel="icon"> --}}

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/animate/animate.min.css')}} " rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}} " rel="stylesheet">
    <link href="{{ asset('frontend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}} " rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css')}}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    {{-- Datatatble --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://nightly.datatables.net/buttons/css/buttons.bootstrap4.min.css">

</head>

<body>
    <div class="container-xxl bg-white p-0">
        {{-- <!-- Spinner Start -->
        @include('layouts.frontend.spiner-start')
        <!-- Spinner End --> --}}


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            @include('layouts.frontend.nav')
            @include('layouts.frontend.detail')
        </div>
        <!-- Navbar & Hero End -->


        @yield('content')

        <!-- Footer Start -->
        @include('layouts.frontend.footer')
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js')}} "></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js')}} "></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{ asset('frontend/lib/counterup/counterup.min.js')}}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js')}}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>

    {{-- DataTables --}}
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/datatables/Buttons-1.7.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/Buttons-1.7.1/js/buttons.bootstrap4.min.js') }}"></script> --}}
    <script src="https://nightly.datatables.net/buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://nightly.datatables.net/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('assets/vendor/datatables/JSZip-2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/pdfmake-0.1.36/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/pdfmake-0.1.36/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/Buttons-1.7.1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/Buttons-1.7.1/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/datatables/Buttons-1.7.1/js/buttons.colVis.min.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js')}}"></script>
    @yield('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                var target = this.hash;
                $('html, body').animate({
                scrollTop: $(target).offset().top
                }, 800);
            });

            const error = '{{ session('error') }}';
            if (error) {
                Swal.fire(
                    'Invalid',
                    error,
                    'error'
                )
                sessionStorage.clear();
            }

            const success = '{{ session('success') }}';
            if (success) {
                toastr.success('', success, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

                sessionStorage.clear();
            }
        });
    </script>
    @yield('script')
</body>

</html>
