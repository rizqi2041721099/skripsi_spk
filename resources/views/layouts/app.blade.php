<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/logo/bca_logo.png') }}" type="image/png"> --}}


    {{-- <link rel="stylesheet" href="{{ asset('css/loader.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <!-- Ruang Admin  -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- ClockPicker -->
    <link href="{{ asset('assets/vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">

    <!-- Bootstrap DatePicker -->
    <link href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">

    {{-- <script src="https://kit.fontawesome.com/d7e83bf142.js" crossorigin="anonymous"></script> --}}

    <!-- Select2 -->
    <link href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Datatatble --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://nightly.datatables.net/buttons/css/buttons.bootstrap4.min.css">

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body id="page-top">
    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            @yield('main')
        </div>
    </div>

    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin logout</p>
                </div>
                <div class="modal-footer">
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
                        <button id="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }} "></script>
    <script src="{{ asset('assets/js/ruang-admin.min.js') }} "></script>
    <script src="{{ asset('assets/js/currency.js') }} "></script>

    {{-- Price Format --}}
    <script src="{{ asset('assets/js/price.format.1.7.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script src="{{ asset('assets/cleave.js-master/src/addons/phone-type-formatter.id.js') }}"></script>

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

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

    <!-- ClockPicker -->
    <script src="{{ asset('assets/vendor/clock-picker/clockpicker.js') }}"></script>

    {{-- Auto Numeric Price Format  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.1.0/autoNumeric.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            if (sessionStorage.getItem('success')) {
                let data = sessionStorage.getItem('success');
                toastr.success('', data, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

                sessionStorage.clear();
            }

            const error = '{{ session('error') }}';
            if (error) {
                toastr.error('', error, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

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

            $('#simple-date1 .input-group.date').datepicker({
                format: 'dd/mm/yyyy',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true,
            });

            $('#date .input-group.date').datepicker({
                format: 'dd-mm-yyyy',
                todayBtn: 'linked',
                todayHighlight: true,
                autoclose: true,
            });

            $('#simple-date4 .input-daterange').datepicker({
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                todayBtn: 'linked',
            });


        });
    </script>
</body>

</html>
