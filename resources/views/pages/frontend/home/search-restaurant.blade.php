@extends('layouts.frontend.app-detail')
@section('title-head')
    Search
@endsection
@section('list')
    <li class="breadcrumb-item text-white active" aria-current="page">Restaurants</li>
@endsection
@section('content')
<div class="container-xxl py-5" id="about-us">
    <div class="container">
        <div class="row g-5 align-items-center">
            <h6>Data Bobot Kriteria</h6>
            @if (Auth::check())
                    <table class="table table-striped" width="100%" id="bobot_kriteria_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Harga Makanan</th>
                                <th>Bobot Jarak</th>
                                <th>Fasilitas</th>
                                <th>Jam Operasional</th>
                                <th>Variasi Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Harga Makanan</th>
                                <th>Bobot Jarak</th>
                                <th>Fasilitas</th>
                                <th>Jam Operasional</th>
                                <th>Variasi Menu</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                @else
                <table class="table table-striped" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Harga Makanan</th>
                            <th>Bobot Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Menu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $data = App\Models\BobotKriteria::get();
                        @endphp
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->bobot_harga_makanan.'%' }}</td>
                                <td>{{ $item->bobot_jarak.'%' }}</td>
                                <td>{{ $item->bobot_fasilitas.'%' }}</td>
                                <td>{{ $item->bobot_jam_operasional.'%' }}</td>
                                <td>{{ $item->bobot_variasi_menu.'%' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Harga Makanan</th>
                            <th>Bobot Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Menu</th>
                        </tr>
                    </tfoot>
                </table>
            @endif
        </div>
    </div>
</div>

<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-12 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="d-flex justify-content-between">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Search Restaurants</h5>
                    <a href="{{ route('login') }}" class="btn btn-outline-warning text-capitalize">Tambah Restaurant</a>
                </div>
                <h1 class="text-white mb-4">Temukan restaurant yang kamu cari!</h1>
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="variasi_menu" id="" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getVariasiMenu as $item)
                                        <option value="{{ $item->id }}">{{ $item->range_value }}  variasi makanan</option>
                                    @endforeach
                                </select>
                                <label for="range-variasi-makanan">Kriteria Variasi Menu</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="jarak" id="jarak" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getJarak as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard_value.' | '.$item->range_value }}</option>
                                    @endforeach
                                </select>
                                <label for="rentang-jarak">Kriteria Jarak</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="harga" id="harga" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getHarga as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard_value.' | '.$item->range_value }}</option>
                                    @endforeach
                                </select>
                                <label for="range-harga">Kriteria Harga Makanan</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="jam_operasional" id="jam_operasional" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getJamOperasional as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard_value }} ({{ $item->range_value }})</option>
                                    @endforeach
                                </select>
                                <label for="select1">Kriteria Jam Operasional</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="fasilitas" id="fasilitas" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach ($getFasilitas as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard_value }}</option>
                                    @endforeach
                                </select>
                                <label for="select1">Kriteria Fasilitas</label>
                            </div>
                        </div>
                        {{-- <div class="col-12">
                            <label for="facility" class="form-label text-white fw-bold">Detail Fasilitas</label>
                            <div class="d-flex flex-wrap">
                                @foreach($facilities as $facility)
                                    <div class="form-check me-3">
                                        <input type="checkbox" name="facility_id[]" value="{{ $facility->id }}" id="facility_{{ $facility->id }}" class="form-check-input">
                                        <label for="facility_{{ $facility->id }}" class="form-check-label text-white fw-semibold">{{ $facility->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <button class="btn btn-secondary w-100 py-3" type="button" id="reset">Reset</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary w-100 py-3" type="button" id="filter">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="container-xxl py-5">
    <div class="container">
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
        {{-- <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">Restaurant</h5>
        </div>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.1s">
            <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                <li class="nav-item">
                    <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                        <i class="fa fa-star fa-2x text-primary"></i>
                        <div class="ps-3">
                            <small class="text-body">Popular</small>

                        </div>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">

                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@include('pages.frontend.home.modal')
@include('pages.frontend.home.modal-bobot')
<script>
    $(document).ready(function(){
        $('#bobot_kriteria_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('bobot-kriteria.index') }}",
                type: 'GET',
            },
            "responsive": false,
            "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ],
            "language": {
                "oPaginate": {
                    "sNext": "<i class='fas fa-angle-right'>",
                    "sPrevious": "<i class='fas fa-angle-left'>",
                },
            },
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'b_harga_makanan',
                },
                {
                    data: 'b_jarak',
                },
                {
                    data: 'b_fasilitas',
                },
                {
                    data: 'b_jam_operasional',
                },
                {
                    data: 'b_variasi_menu',
                },
                {
                    data: 'action',
                },
            ],
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
                            // toastr.success('Data Restaurants ditemukan',{
                            //     fadeOut: 1000,
                            //     swing: 300,
                            //     fadeIn: 5000,
                            //     linear: 1000,
                            //     timeOut: 3000,
                            // });
                            $('#data-restaurants').removeClass("d-none");
                            response.alternatif_hasil.forEach(function(response) {
                                // var sum = 0;
                                // var count = restaurant.comments.length;
                                // for (var i = 0; i < count; i++) {
                                //     sum += restaurant.comments[i].star_rating;
                                // }
                                // var average = count > 0 ? sum / count : 0;
                                id = response.alternatif.restaurant['id'];

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
                                                '<a href="/detail-restaurant/' + id + '">' +
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
                            // var row = $('#tab-1 .row');
                            // row.empty()
                            // response.forEach(function(restaurant) {
                            //     var sum = 0;
                            //     var count = restaurant.comments.length;
                            //     for (var i = 0; i < count; i++) {
                            //         sum += restaurant.comments[i].star_rating;
                            //     }
                            //     var average = count > 0 ? sum / count : 0;
                            //     id = restaurant.id;

                            //     var starColor = average > 0 ? '#ffcd3c' : '#aaa';
                            //     var starHtml = '';
                            //     if (average > 0) {
                            //         for (var i = 0; i < parseInt(average); i++) {
                            //             starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                            //         }
                            //     } else {
                            //         starHtml += '<i class="fa fa-star fa-xs" style="color: ' + starColor + '; font-size: 16px" aria-hidden="true"></i>';
                            //     }
                            //     var link = '{{ route("detail.restaurant", ":id") }}';
                            //     link = link.replace(':id', id);

                            //     var column = `<div class="col-lg-6">`;
                            //     column += `<a href="${link}">`;
                            //     column += `<div class="d-flex align-items-center">
                            //         <img class="flex-shrink-0 img-fluid rounded" src="{{ asset('frontend/img/restaurant.jpg')}}" alt="" style="width: 80px;">
                            //         <div class="w-100 d-flex flex-column text-start ps-4">
                            //             <h5 class="d-flex justify-content-between border-bottom pb-2">
                            //                 <span>${restaurant.name}</span>
                            //                 <span class="text-primary">${starHtml}</span>
                            //             </h5>
                            //             <small class="fst-italic">
                            //                 ${restaurant.facilities.length > 0 ? restaurant.facilities.map(item => item.name).join(', ') : '-'}
                            //             </small>
                            //         </div>
                            //     </div>`;
                            //     column += '</a>';
                            //     column += `</div>`;
                            //    row.append(column);

                            // });
                        } else {
                           $('.modal').show();
                           $('#btn-close').click(function(){
                                $('.modal').hide();
                           });
                        }
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                }
            });
        }

        $('#reset').click(function() {
            $('input[type="checkbox"]').prop('checked', false);
            filterRestaurants();
        });

        $('#form-edit').on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            let id = $('#id').val();

            $.ajax({
                url: 'bobot-kriteria/' + id,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        $("#form-edit")[0].reset();
                        $('#edit-modal').modal('hide'); //modal hide
                        var oTable = $('#bobot_kriteria_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_edit_bobot_harga_makanan').text(response.responseJSON.errors.bobot_harga_makanan);
                    $('#error_edit_bobot_harga_jarak').text(response.responseJSON.errors.bobot_harga_jarak);
                    $('#error_edit_bobot_harga_fasilitas').text(response.responseJSON.errors.bobot_harga_fasilitas);
                    $('#error_edit_bobot_rasa_makan').text(response.responseJSON.errors.bobot_rasa_makan);
                    $('#error_edit_bobot_variasi_menu').text(response.responseJSON.errors.bobot_variasi_menu);
                },
            });
        })
    });

    $('#back').on('click', function(){
        $('#edit-modal').modal('hide');
    });

    function updateItem(e) {
        let id = e.getAttribute('data-id');

        $.ajax({
            type: 'GET',
            url:  'bobot-kriteria/' + id + '/edit',
            success: function (response) {
                $('#id').val(response.id);
                $('#edit_bobot_harga_makanan').val(response.bobot_harga_makanan);
                $('#edit_bobot_jarak').val(response.bobot_jarak);
                $('#edit_bobot_fasilitas').val(response.bobot_fasilitas);
                $('#edit_bobot_jam_operasional').val(response.bobot_jam_operasional);
                $('#edit_bobot_variasi_menu').val(response.bobot_variasi_menu);
                $('#edit-modal').modal('show');
            }
        })
    }
</script>
@endsection
