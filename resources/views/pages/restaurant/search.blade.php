@extends('layouts.main-content')
@section('title','Search Restaurants')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Search Restaurants</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Search Restaurants</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Filter Restaurant</h6>
                </div>
                <form id="filterForm">
                    <div class="row px-3">
                        {{-- <div class="col-md-4 ml-3">
                            <label for="">Restaurant</label>
                            <select  class="select2-single form-control" data-toggle="select" id="restaurant" name="restaurant_id" width="100%"></select>
                        </div> --}}
                        <div class="col-md-4">
                            <label for="">Rentang Variasi Menu Makanan</label>
                            <select name="variasi_menu" id="maxQty" class="form-control">
                                <option value="">Pilih</option>
                                <option value="5"> > 20</option>
                                <option value="4"> 15 - 20 </option>
                                <option value="3"> 10 - 15 </option>
                                <option value="2"> 5 - 10 </option>
                                <option value="1"> < 5 </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rentang Jarak</label>
                            <select name="jarak" id="jarak" class="form-control">
                                <option value="">Pilih</option>
                                <option value="5"> < 1 KM</option>
                                <option value="4"> 1 - 3 KM</option>
                                <option value="3"> 3 - 5 KM </option>
                                <option value="2"> 5 - 7 KM </option>
                                <option value="1"> > 7 KM </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rentang Harga</label>
                            <select name="harga" id="harga" class="form-control">
                                <option value="">Pilih</option>
                                <option value="5"> Rp. 2.000,00 - Rp. 15.000,00</option>
                                <option value="3"> Rp. 15.000,00 - Rp. 25.000,00</option>
                                <option value="1"> > Rp. 25.000,00 </option>
                            </select>
                        </div>
                    </div>
                    <label for="" class="ml-4 mt-3">fasilitas</label>
                    <div class="row">
                        @foreach($facilities as $facility)
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}" id="facility">
                                    <label for="facility_{{ $facility->id }}">{{ $facility->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row m-3 ">
                        <div class="col-lg-2 col-md-6 col-sm-12 col-xs-12">
                            <div style="margin-top: 35px;">
                                <button type="button" name="filter" id="filter"
                                    class="btn btn-primary">Cari</button>
                                <button type="button" name="reset" id="reset"
                                    class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Show Restaurants</h6>
                </div>
                <div class="card-body">
                    <table id="data-restaurants" class="table table-bordered d-none" width="100%">
                        <thead>
                            <tr>
                                <th>Restaurant</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="column_name"></td>
                                <td id="column_address"></td>
                                <td id="column_action"></td>
                            </tr>
                        </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.restaurant.modal')
</div>
<script type="application/javascript">
    $(document).ready(function () {
        $('#restaurant').select2({
            placeholder: "cari restaurant",
            allowClear: true,
            ajax: {
                url: "{{ route('get-restaurant') }}",
                dataType: 'json',
                type: "POST",
                delay: 250,
                data: function(params) {
                    return {
                        "_token": "{{ csrf_token() }}",
                        search: params.term // search term
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: false
            }
        });

        $('#filter').click(function() {
            filterRestaurants();
        });

        function filterRestaurants() {
            var formData = $('#filterForm').serialize();
            $.ajax({
                type: 'GET',
                url: '{{ route("filter.restaurants") }}',
                data: formData,
                success: function(response) {
                    if(response.length != 0)
                    {
                        $('#data-restaurants tbody').empty();
                        $('#data-restaurants').removeClass("d-none");
                        response.forEach(function(restaurant) {
                            id = restaurant.id;
                            var row = '<tr>' +
                                        '<td>' + restaurant.name + '</td>' +
                                        '<td>' + restaurant.address + '</td>' +
                                        '<td>' + '<a href="/restaurants/' + id + '" class="btn btn-sm btn-secondary btn-icon-only">' +
                                        '<span class="btn-inner--icon"><i class="fas fa-eye"></i></span>' +
                                        '</a>' +
                                        '</td>' +
                                    '</tr>';
                            $('#data-restaurants').append(row);
                        });
                    } else {
                        toastr.warning('warning','Data tidak ditemukan');
                    }
                }
            });
        }

        // Event listener untuk tombol "Reset"
        $('#reset').click(function() {
            // Uncheck all checkboxes
            $('input[type="checkbox"]').prop('checked', false);
            // Lakukan filter ulang
            filterRestaurants();
        });
    });
</script>
@endsection
