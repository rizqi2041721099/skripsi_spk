@extends('layouts.frontend.app-detail')
@section('title-head')
    Detail
@endsection
@section('list')
    <li class="breadcrumb-item text-white active" aria-current="page">Restaurants</li>
@endsection
@section('content')
<div class="container-xxl py-5" id="about-us">
    <div class="container">
        <div class="row g-5 align-items-center">
            <h1 class="mb-4">Welcome to <i class="fa fa-utensils text-primary me-2"></i>Restoran {{ $restaurant->name }}</h1>
            <div class="col-md-4">
                @if (is_null($restaurant->images) || $restaurant->images == '')
                    <img src="{{ asset('frontend/img/restaurant.jpg')}}" alt="img" class="rounded" width="100%">
                @else
                    <img src="{{ Storage::url('public/images/restaurants/' . $restaurant->images) }}"
                        alt="img" class="rounded" width="100px" height="150px">
                @endif
            </div>
            <div class="col-md-6">
                <h4>Detail Restaurant</h4>
                <table class="table table-borderless">
                    <tr>
                        <th>Alamat</th>
                        <td class="text-end">{{ $restaurant->address }}</td>
                    </tr>
                    <tr>
                        <th>Fasilitas</th>
                        <td class="text-end">
                            @if (!$restaurant->facilities)
                                -
                            @else
                                @foreach ($restaurant->facilities as $item)
                                    {{ $item->name . ', ' }}
                                @endforeach
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Jarak</th>
                        <td class="text-end">{{ $restaurant->distance }} m</td>
                    </tr>
                    <tr>
                        <th>Link Gmaps</th>
                        <td class="text-end">
                        @if (empty($restaurant->map_link))
                            <span class="text-danger fw-bold">tidak ada link gmaps</span>
                        @else
                            <a href="{{ $restaurant->map_link }}" class="btn btn-sm btn-primary" target="_blank"><i
                                    class="fa fa-map-marker" aria-hidden="true"></i>
                                check location</a>
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Rata - Rata Harga</th>
                        <td class="text-end"> {{ number_format($restaurant->average) }}</td>
                    </tr>
                    <tr>
                        <th>Qty Variasi Makanan</th>
                        <td class="text-end">  {{ $restaurant->qty_variasi_makanan }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-12">
                <h4>Variasi Menu</h4>
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($food_variaty as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ number_format($item->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Menu</th>
                            <th>Harga</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="col-md-12">
                <h4>Data Alternatif</h4>
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
@endsection
