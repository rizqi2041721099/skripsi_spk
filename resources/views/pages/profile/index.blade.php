@extends('layouts.main-content')
@section('title', 'Profile')
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
                        <a href="{{ url('/profile/' . $data->id . '/edit') }}" class="btn btn-primary rounded text-center">Edit Profile</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" value="{{ $data->name }}" readonly>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Email</label>
                                <input type="email" class="form-control" value="{{ $data->email }}" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="">Roles</label>
                                <input type="text" class="form-control" value="{{ $data->roles->first()->name }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
