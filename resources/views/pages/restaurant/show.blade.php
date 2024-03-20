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
            <div class="table-responsive">
                <table class="table table-flush" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Resturant</th>
                            <th>Alamat</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Image</th>
                            <th>Harga</th>
                            <th>Qty Variasi Makanan</th>
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
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
