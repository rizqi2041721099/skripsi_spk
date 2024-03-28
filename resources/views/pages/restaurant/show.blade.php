@extends('layouts.main-content')
@section('title', 'Detail Restaurants')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Restaurant</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active"><a href="#">Detail Restaurant</a></li>
        </ol>
    </div>
    <div class="card mb-3" style="margin-top: -20px !important">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="font-weight-bold text-primary">
                Detail Restaurant
            </h6>
        </div>
        <div class="card-body">
            <h6 class="font-weight-bold">Data Restaurant</h6>
            <div class="table-responsive my-3">
                <table class="table table-bordered" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Resturant</th>
                            <th>Alamat</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Image</th>
                            <th>Rata-rata Harga</th>
                            <th>Qty Variasi Makanan</th>
                            <th>Link Gmaps</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $restaurant->name }}</td>
                            <td>{{ $restaurant->address }}</td>
                            <td>{{ $restaurant->distance }}</td>
                            <td>
                                @if (!$restaurant->facilities)
                                     -
                                @else
                                @foreach ($restaurant->facilities as $item)
                                    {{ $item->name. ', ' }}
                                @endforeach
                                @endif
                            </td>
                            <td>
                                @if (is_null($restaurant->images) || $restaurant->images == "")
                                    <img src="{{ asset('assets/img/default.png') }}" alt="img" class="rounded" width="70px" height="70px">
                                @else
                                    <img src="{{ Storage::url('public/images/restaurants/'.$restaurant->images) }}" alt="img" class="rounded" width="70px" height="70px">
                                @endif
                            </td>
                            <td>
                                {{ number_format($restaurant->average) }}
                            </td>
                            <td>
                                {{ $restaurant->qty_variasi_makanan }}
                            </td>
                            <td>
                                @if (empty($restaurant->map_link))
                                    <span class="text-danger fw-bold">tidak ada link gmaps</span>
                                    @else
                                    <a href="{{ $restaurant->map_link }}" class="btn btn-sm btn-primary" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        check location</a>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="table-responsive my-5">
                    <h6 class="font-weight-bold">Data Alternatif</h6>
                    <table class="table table-bordered" width="100%" id="alternatif_table">
                        <thead>
                            <tr>
                                <th rowspan="2" width="15%">Restaurant</th>
                                <th colspan="5" class="text-center">Kriteria</th>
                            </tr>
                            <tr>
                                <th>Harga Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                                <th>Rasa Makanan</th>
                                <th>Variasi Makanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $restaurant->name }}</td>
                                <td>{{ $restaurant->harga->value }}</td>
                                <td>{{ $restaurant->jarak->value }}</td>
                                <td>{{ $restaurant->fasilitas->value }}</td>
                                <td>{{ $restaurant->rasa->value }}</td>
                                <td>{{ $restaurant->variasiMenu->value }}</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Restaurant</th>
                                <th>Harga Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                                <th>Rasa Makanan</th>
                                <th>Variasi Makanan</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
