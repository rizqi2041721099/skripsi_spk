@extends('layouts.main-content')
@section('title', 'Landing Page')
@section('content')
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>
    </div>

    <div class="row mb-3">
      <!-- Earnings (Monthly) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row align-items-center">
              <div class="col mr-2">
                @php
                    $tempat_makan = App\Models\Restaurant::count();
                @endphp
                <div class="text-xs font-weight-bold text-uppercase mb-1">Tempat Makan</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tempat_makan }}</div>
              </div>
              <div class="col-auto">
                <i class="fa fa-building fa-2x text-primary"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Earnings (Annual) Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                @php
                    $kriteria = App\Models\Kriteria::count();
                @endphp
                <div class="text-xs font-weight-bold text-uppercase mb-1">Kriteria</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kriteria }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-list fa-2x text-success"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- New User Card Example -->
      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                @php
                    $users = App\Models\User::count();
                @endphp
                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $users }}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-users fa-2x text-info"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->
@endsection
