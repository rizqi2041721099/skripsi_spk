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
                            @foreach ($getVariasiMenu as $item)
                                <option value="{{ $item->id }}">{{ $item->range_value }}  variasi makanan</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rentang Jarak</label>
                            <select name="jarak" id="jarak" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($getJarak as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value.' | '. $item->range_value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rentang Harga</label>
                            <select name="harga" id="harga" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($getHarga as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value.' | '.$item->range_value }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Kriteria Jam Operasional</label>
                            <select name="jam_operasional" id="jam_operasional" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($getJamOperasional as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value }} ({{ $item->range_value }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="">Kriteria Fasilitas</label>
                            <select name="fasilitas" id="fasilitas" class="form-control">
                                <option value="">Pilih</option>
                                @foreach ($getFasilitas as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <label for="" class="ml-4 mt-3">Fasilitas</label>
                    <div class="row">
                        @foreach($facilities as $facility)
                            <div class="col-md-2">
                                <div class="form-check">
                                    <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}" id="facility">
                                    <label for="facility_{{ $facility->id }}">{{ $facility->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div> --}}
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
                                {{-- <th rowspan="2" width="15%">No</th> --}}
                                <th rowspan="2" width="15%">Restaurant</th>
                                <th colspan="5" class="text-center">Kriteria</th>
                                <th rowspan="2" width="15%">Jumlah</th>
                            </tr>
                            <tr>
                                <th>Harga Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                                <th>Jam Operasional</th>
                                <th>Variasi Makanan</th>
                            </tr>
                        </thead>
                        <tbody>
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
                url: "{{ route('get.restaurant') }}",
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
                    if(response.success == true){
                        toastr.success(response.message);
                        if(response.length != 0)
                        {
                            $('#data-restaurants tbody').empty();
                            $('#data-restaurants').removeClass("d-none");
                            response.alternatif_hasil.forEach(function(response) {

                                    // console.log([response.v_jarak,response,v_jam_operasional,response.v_fasilitas,response.variasi_menu]);
                                    // var sum = 0;
                                    // var count = restaurant.comments.length;
                                    // for (var i = 0; i < count; i++) {
                                    //     sum += restaurant.comments[i].star_rating;
                                    // }
                                    // var average = count > 0 ? sum / count : 0;
                                    id = response.alternatif['id'];

                                    // var starColor = average > 0 ? '#ffcd3c' : '#aaa';
                                    // var starHtml = '';
                                    // if (average > 0) {
                                    //     for (var i = 0; i < parseInt(average); i++) {
                                    //         starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                                    //     }
                                    // } else {
                                    //     starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                                    // }

                                    var row = '<tr>' +
                                                // '<td>' + (response.index + 1)+ '</td>' +
                                                '<td>' +
                                                    '<a href="/restaurants/' + id + '">' +
                                                    response.alternatif.restaurant['name'] +
                                                '</a>' + '</td>' +
                                                '<td>' + response.v_harga_makanan + '</td>' +
                                                '<td>' + response.v_jarak + '</td>' +
                                                '<td>' + response.v_fasilitas + '</td>' +
                                                '<td>' + response.v_jam_operasional + '</td>' +
                                                '<td>' + response.v_variasi_makanan + '</td>' +
                                                '<td>' + response.jumlah_nilai + '</td>' +
                                            '</tr>';

                                    $('#data-restaurants').append(row);

                            });
                    } else if(response.success == false){
                        toastr.error(response.message);
                    }
                }
                }
            });
        }

        $('#reset').click(function() {
            $('input[type="checkbox"]').prop('checked', false);
            filterRestaurants();
        });
    });
</script>
@endsection
