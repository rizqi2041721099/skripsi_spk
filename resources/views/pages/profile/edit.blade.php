@extends('layouts.main-content')
@section('title', 'Edit Profile')
@section('content')
    <div class="container-fluid" id="container-wrapper">
        <p class="font-weight-bold">Profile User</p>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow rounded" style="width: 18rem;">
                    <img class="img-profile rounded-circle mx-auto my-2" src="{{asset('assets/img/boy.png')  }}" width="50%" alt="profile">
                    <div class="card-body">
                      <p class="card-text text-center font-weight-bold text-uppercase">{{ $data->name }}</p>
                    </div>
                  </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <p>Detail Profile</p>
                    </div>
                    <div class="card-body">
                        <form id="form-profile" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <input type="hidden" id="id" value="{{ $data->id }}">
                                <div class="col-md-6 mb-2">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name">
                                    <small class="text-danger" id="error_name"></small>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" value="{{ $data->email }}" name="email">
                                    <small class="text-danger" id="error_email"></small>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Role</label>
                                    <input type="text" class="form-control" value="{{ $data->roles->first()->name }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label>Password <span><small class="text-warning">(kosongi password jika tidak di update.)</small></span></label>
                                    <div class="input-group mb-0">
                                        <input type="password" class="form-control" id="password" name="password" value="">
                                        <div class="input-group-append" style="cursor: pointer !important">
                                          <span class="input-group-text"><i class="fa fa-eye-slash text-white" aria-hidden="true"  onclick="newPassword()" id="toggle-icon"></i></span>
                                        </div>
                                    </div>
                                    <small class="text-danger" id="error_password"></small>
                                </div>
                                <div class="form-group mt-3">
                                    <a href="{{ route('profile') }}" class="btn btn-secondary btn-icon-split">
                                        <span class="icon text-gray-600">
                                            <i class="fas fa-arrow-left"></i>
                                        </span>
                                        <span class="text">Kembali</span>
                                    </a>
                                    <button id="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

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

        $(document).ready(function() {
            $("#form-profile").on('submit', function(e) {
                    e.preventDefault();
                    let formData = new FormData(this);
                    let id = $('#id').val();

                    $.ajax({
                        url: "/profile-update/"+ id,
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            sessionStorage.setItem('success', response.message);
                            window.location.href = "/profile";
                        },
                        error: function(response) {
                            $('#error_name').text(response.responseJSON.errors.name);
                            $('#error_email').text(response.responseJSON.errors.email);
                            $('#error_password').text(response.responseJSON.errors.password);
                        },
                    });
            })
        });
    </script>
@endsection
