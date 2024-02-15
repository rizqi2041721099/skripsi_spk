@extends('layouts.main-content')
@section('title', 'Edit User')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit User</a></li>
            </ol>
        </div>
        <div class="card mb-5">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Edit User
                </h6>
            </div>
            <div class="card-body mt--2">
                <form id="form-users" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
                                <small class="text-danger" id="error_name"></small>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <small class="text-danger" id="error_email"></small>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xs-12">
                            <div class="form-group">
                                <label class="font-weight-bold">Role</label>
                                <select class="form-control" name="role" style="width: 100%" disabled>
                                    <option value="" selected>---Pilih Role---</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $role->id == $userRole->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger" id="error_role"></small>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xs-12 mb-2">
                            <label>Password <span><small class="text-warning">(kosongi password jika tidak di update.)</small></span></label>
                            <div class="input-group mb-0">
                                <input type="password" class="form-control" name="password"  id="password">
                                <div class="input-group-append" style="cursor: pointer !important">
                                  <span class="input-group-text"><i class="fa fa-eye-slash text-white" aria-hidden="true"  onclick="newPassword()" id="toggle-icon"></i></span>
                                </div>
                            </div>
                            <small class="text-danger" id="error_password"></small>
                        </div>
                    </div>
                    <div class="form-group">
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
    <script>
        function newPassword() {
            const toggleIcon = document.getElementById('toggle-icon');
            var x = document.getElementById("password");
            console.log([toggleIcon,x]);
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
            $("#form-users").on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);


                $.ajax({
                    url: "{{ route('users.update', $user->id) }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        sessionStorage.setItem('success', response.message);
                        window.location.href = "/users";
                    },
                    error: function(response) {
                        toastr.error('error', 'inputan tidak valid, periksa inputan anda')
                        $('#error_name').text(response.responseJSON.errors.name);
                        $('#error_email').text(response.responseJSON.errors.email);
                        $('#error_password').text(response.responseJSON.errors.password);
                    },
                });
            });
        });
    </script>
@endsection
