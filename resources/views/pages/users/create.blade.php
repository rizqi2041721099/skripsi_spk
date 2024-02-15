@extends('layouts.main-content')
@section('title','Tambah User')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
            <li class="breadcrumb-item active"><a href="#">Tambah User</a></li>
        </ol>
    </div>
    <div class="card mb-3" style="margin-top: -20px !important">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">
                Tambah User
            </h6>
        </div>
        <div class="card-body mt--2">
            <form  id="form-users" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            <small class="text-danger" id="error_name"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                            <small class="text-danger" id="error_email"></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Password</label>
                        <div class="input-group mb-0">
                            <input type="password" class="form-control" name="password"  id="password">
                            <div class="input-group-append" style="cursor: pointer !important">
                              <span class="input-group-text"><i class="fa fa-eye-slash text-white" aria-hidden="true"  onclick="newPassword()" id="toggle-icon"></i></span>
                            </div>
                        </div>
                        <small class="text-danger m-0" id="error_password"></small>
                    </div>
                    <div class="col-md-6">
                        <label>Confirm Password</label>
                        <div class="input-group mb-">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                            <div class="input-group-append" style="cursor: pointer !important">
                              <span class="input-group-text"><i class="fa fa-eye-slash text-white" aria-hidden="true"  onclick="confirmPassword()" id="toggle-icon-2"></i></span>
                            </div>
                        </div>
                        <small class="text-danger m-0" id="error_confirm_password"></small>
                    </div>
                </div>
                <div class="form-group mt-2">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                    <button id="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <script>
        function newPassword() {
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

        function confirmPassword() {
            const toggleIcon = document.getElementById('toggle-icon-2');
            var x = document.getElementById("confirm_password");
            if (x.type === "password") {
                toggleIcon.classList.remove('bx', 'bx-hide');
                toggleIcon.classList.add('bx', 'bx-show');
                x.type = "text";
            } else {
                x.type = "password";
                toggleIcon.classList.remove('bx', 'bx-show');
                toggleIcon.classList.add('bx', 'bx-hide');
            }
        };
        $(document).ready(function (){
            $("#form-users").on('submit', function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        sessionStorage.setItem('success', response.message);
                        window.location.href = "/users";
                    },
                    error: function (response) {
                        $('#error_name').text(response.responseJSON.errors.name);
                        $('#error_email').text(response.responseJSON.errors.email);
                        $('#error_password').text(response.responseJSON.errors.password);
                        $('#error_confirm_password').text(response.responseJSON.errors.confirm_password);
                    },
                });
        });
        });
    </script>
@endsection
