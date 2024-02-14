<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Name</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/logo/logo.png') }}" type="image/png">

    <!-- Ruang Admin  -->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/ruang-admin.min.css') }}" rel="stylesheet">

    <script src="https://kit.fontawesome.com/d7e83bf142.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container-login">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 text-center">
                <div class="card shadow-sm my-4 border-bottom-primary">
                    <div class="card-header">
                        <img src="" class="card-img-bottom mt-2"
                            style="max-width: 100px" alt="Photo">
                    </div>
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="h4 text-gray-900 font-weight-bold mt-4 mb-0">APP NAME</h1>
                                <div class="login-form">
                                    <small class="text-danger" id="message-error"></small>
                                    <form method="POST" action="{{ route('login') }}" id="login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control"
                                                placeholder="Username" value="{{ old('name') }}" autofocus>
                                            @error('name')
                                                <span class="small text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password">
                                            @error('password')
                                                <span class="small text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div> --}}
                                        <div class="input-group mb-3">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password">
                                            <div class="input-group-append" style="cursor: pointer !important">
                                              <span class="input-group-text"><i class="fa fa-eye-slash text-white" aria-hidden="true"  onclick="myPassword()" id="toggle-icon"></i></span>
                                            </div>
                                        </div>
                                        @error('password')
                                            <span class="small text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="form-group">
                                            <button type="submit" id="submit"
                                                class="btn btn-primary btn-block shadow">Login</button>
                                            {{-- <button type="submit" id="submit" href="{{ url('login/google') }}"
                                                class="btn btn-white btn-block text-black shadow">
                                                <span>
                                                    <img src="{{ asset('assets/img/google_icon.png') }}" width="30em">
                                                </span>
                                                Google
                                            </button>
                                            <div class="mt-3" style="font-size: 14px">Belum punya akun ? <span><a class="text-decoration-none" href="{{ route('register') }}">Daftar Sekarang</a></span></div> --}}
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </script>
</body>

</html>
