<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up</title>

    <style>
        body{
            *{
                background-color: #fff;
            }
        }
        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
        .h-custom {
        height: calc(100% - 73px);
        }
        @media (max-width: 450px) {
        .h-custom {
        height: 100%;
        }
        }
    </style>
    <!-- Favicon -->
    {{-- <link rel="icon" href="{{ asset('assets/img/logo/logo.png') }}" type="image/png"> --}}

    <!-- Ruang Admin  -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/d7e83bf142.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('frontend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <section class="vh-100">
        <div class="container-fluid h-custom">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-9 col-lg-6 col-xl-5">
              <img src="{{ asset('frontend/img/undraw_monitor_iqpq.png') }}"
                class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                <p class="lead fw-normal mb-0 me-3 mb-3">Sign up</p>
                <form id="form-signup">
                    @csrf
                <!-- Username input -->
                <div data-mdb-input-init class="form-outline my-2">
                    <input type="text" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a username" name="name" />
                    <label class="form-label" for="form3Example3">Username</label>
                    <small class="text-danger" id="error_name"></small>
                </div>
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline my-2">
                  <input type="email" id="form3Example3" class="form-control form-control-lg"
                    placeholder="Enter a valid email address" name="email"/>
                  <label class="form-label" for="form3Example3">Email address</label>
                  <small class="text-danger" id="error_email"></small>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline my-2">
                  <input type="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" name="password"/>
                  <label class="form-label" for="form3Example4">Password</label>
                  <small class="text-danger" id="error_password"></small>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline my-2">
                  <input type="password" id="form3Example4" class="form-control form-control-lg"
                    placeholder="Enter password" name="confirm_password"/>
                  <label class="form-label" for="form3Example4">Confirm Password</label>
                  <small class="text-danger" id="error_confirm_password"></small>
                </div>

                <div class="d-flex justify-content-between align-items-center">
                  <!-- Checkbox -->
                  <div class="form-check mb-0">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                    <label class="form-check-label" for="form2Example3">
                      Remember me
                    </label>
                  </div>
                  {{-- <a href="#!" class="text-body">Forgot password?</a> --}}
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-lg text-white"
                    style="padding-left: 2.5rem; padding-right: 2.5rem; background-color: #FEA116" id="submit">Sign Up</button>
                  <p class="small fw-bold mt-2 pt-1 mb-0">Do You have an account? <a href="{{ route('auth.login') }}"
                      class="link-danger">Sign In</a></p>
                </div>

              </form>
            </div>
          </div>
        </div>
      </section>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }} "></script>
    <script src="{{ asset('assets/js/ruang-admin.min.js') }} "></script>
   <script>
         function myPassword() {
            const toggleIcon = document.getElementById('toggle-icon');
            var x = document.getElementById("password");
            if (x.type === "password") {
                toggleIcon.classList.remove('fa', 'fa-eye-slash');
                toggleIcon.classList.add('fa', 'fa-eye');
                x.type = "text";
            } else {
                x.type = "password";
                toggleIcon.classList.remove('fa', 'fa-eye');
                toggleIcon.classList.add('fa', 'fa-eye-slash');
            }
        };
        $(document).ready(function() {
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

            $('#form-signup').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $('#error_name').text('');
                $('#error_email').text('');
                $('#error_password').text('');
                $('#error_confirm_password').text('');

                var btn = $('#submit');
                btn.text('Loading....');
                btn.attr('disabled');

                $.ajax({
                    url: "{{ route('store.signup') }}",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            sessionStorage.setItem('success', response.message);
                            window.location.href = "/";
                        } else {
                            btn.text('SAYA SETUJU, LANJUT DAFTAR')
                            toastr.error(response.message);
                        }
                    },
                    error: function(response) {
                        btn.text('SAYA SETUJU, LANJUT DAFTAR')
                        btn.removeAttr('disabled');
                        $('#error_name').text(response.responseJSON.errors
                            .name);
                        $('#error_email').text(response.responseJSON.errors.email);
                        $('#error_password').text(response.responseJSON.errors.password);
                        $('#error_confirm_password').text(response.responseJSON.errors
                            .confirm_password);
                    }
                })
            })
        });
    </script>
</body>

</html>
