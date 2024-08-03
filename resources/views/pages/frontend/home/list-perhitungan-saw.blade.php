@extends('layouts.frontend.app-detail')
@section('title-head')
    Ranking
@endsection
@section('list')
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="/tambah-perhitungan-saw">Perhitungan Saw</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Normalisasi & Ranking</li>
    </ol>
@endsection
@section('content')
    <div class="container-xxl py-5" id="about-us">
        @php
            $bobotUser = App\Models\BobotUser::where('user_id',auth()->user()->id)->first();
        @endphp
        @if (is_null($bobotUser))
            <div class="row g-0 mb-5">
                <div class="col-md-12 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="d-flex justify-content-between">
                            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Bobot Kriteria</h5>
                        </div>
                        <h1 class="text-white mb-4">Anda belum menginput data bobot!</h1>
                        <form id="form_bobot">
                            @csrf
                            <div class="row g-3">
                                <h6 class="fw-bold text-white">Bobot Kriteria (format angka)</h6>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                    <input type="text" class="form-control" name="bobot_harga_makanan" value="{{ old('bobot_harga_makanan') }}" required>
                                        <label for="range-variasi-makanan">Bobot Harga Makanan</label>
                                    </div>
                                    <span class="text-danger" id="error_bobot_harga_makanan"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                    <input type="text" class="form-control" name="bobot_jarak" value="{{ old('bobot_jarak') }}" required>
                                        <label for="range-variasi-makanan">Bobot Jarak</label>
                                    </div>
                                    <span class="text-danger" id="error_bobot_jarak"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                    <input type="text" class="form-control" name="bobot_fasilitas" value="{{ old('bobot_fasilitas') }}" required>
                                        <label for="range-variasi-makanan">Bobot Fasilitas</label>
                                    </div>
                                    <span class="text-danger" id="error_bobot_fasilitas"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                    <input type="text" class="form-control" name="bobot_jam_operasional" value="{{ old('bobot_jam_opearsional') }}" required>
                                        <label for="range-variasi-makanan">Bobot Jam Operasional</label>
                                    </div>
                                    <span class="text-danger" id="error_bobot_jam_operasional"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating">
                                    <input type="text" class="form-control" name="bobot_variasi_menu" value="{{ old('bobot_variasi_menu') }}" required>
                                        <label for="range-variasi-makanan">Bobot Variasi Menu</label>
                                    </div>
                                    <span class="text-danger" id="error_bobot_variasi_menu"></span>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" id="submit-button">Tambah</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="row g-5 align-items-center mb-5">
                <h5>Data Bobot Kriteria Anda</h5>
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
            </div>
        @endif

        <div class="container">
            <div class="row g-5 align-items-center mb-5">
                <h5>Data Alternatif Anda</h5>
                <table class="table table-striped" width="100%" id="alternatif_table">
                    <thead>
                        <tr>
                            <th rowspan="2" width="15%">No</th>
                            <th rowspan="2" width="15%">Restaurant</th>
                            <th colspan="5" class="text-center">Kriteria</th>
                            <th rowspan="2" width="15%">Action</th>
                        </tr>
                        <tr>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Menu</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Restaurant</th>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Menu</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row g-5 align-items-center mb-5">
                <h5>Data Normalisasi</h5>
                <table class="table table-striped" width="100%" id="normalisasi_table">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="15%">No</th>
                            <th rowspan="2" width="15%">Restaurant</th>
                            <th colspan="5" class="text-center">Kriteria</th>
                        </tr>
                        <tr>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Makanan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Restaurant</th>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Makanan</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <hr>
            <div class="row g-5 align-items-center">
                <h5>Data Ranking</h5>
                <table class="table table-striped" width="100%" id="ranking_table">
                    <thead class="table-dark">
                        <tr>
                            <th rowspan="2" width="15%">No</th>
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
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Restaurant</th>
                            <th>Harga Makanan</th>
                            <th>Jarak</th>
                            <th>Fasilitas</th>
                            <th>Jam Operasional</th>
                            <th>Variasi Makanan</th>
                            <th>Jumlah</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @include('pages.frontend.home.modal')
    <script type="text/javascript">
        $(document).ready(function() {
            if (sessionStorage.getItem('success')) {
                let data = sessionStorage.getItem('success');
                toastr.success('', data, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

                sessionStorage.clear();
            }

            const error = '{{ session('error') }}';
            if (error) {
                toastr.error('', error, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

                sessionStorage.clear();
            }

            const success = '{{ session('success') }}';
            if (success) {
                toastr.success('', success, {
                    timeOut: 1500,
                    preventDuplicates: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                });

                sessionStorage.clear();
            }
        });
    </script>

    @section('scripts')
        <script type="application/javascript">
            $(document).ready(function () {
                $('#bobot_kriteria_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('list.bobot.user') }}",
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

                $('#form_bobot').on('submit', function(event) {
                    event.preventDefault();
                    var formData = new FormData(this);

                    var btn = $('#submit-button');
                    btn.attr('disabled', true);
                    btn.val(btn.data("loading-text"));

                    $.ajax({
                        url: "{{ route('store.bobot.user') }}",
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            if (response.success == true) {
                                window.location.href = 'list-perhitungan-saw';
                                sessionStorage.setItem('success', response.message);
                            } else if (response.success == false) {
                                btn.attr('disabled', false);
                                btn.text('Submit');
                                toastr.error('error', response.message);
                            }
                        },
                        error: function(response) {
                            btn.attr('disabled', false);
                            btn.text('Submit');
                            $('#error_bobot_harga_makanan').text(response.responseJSON.errors.bobot_harga_makanan);
                            $('#error_bobot_harga_jarak').text(response.responseJSON.errors.bobot_harga_jarak);
                            $('#error_bobot_harga_fasilitas').text(response.responseJSON.errors.bobot_harga_fasilitas);
                            $('#error_bobot_jam_operasional').text(response.responseJSON.errors.bobot_jam_operasional);
                            $('#error_bobot_variasi_menu').text(response.responseJSON.errors.bobot_variasi_menu);
                        }
                    });
                });

                $('#form-edit').on('submit', function (event) {
                    event.preventDefault();
                    let formData = new FormData(this);
                    let id = $('#id').val();

                    $.ajax({
                        url: 'update-bobot-user/' + id,
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

                $('#alternatif_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('alternatif.user') }}",
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
                            data: 'restaurant',
                        },
                        {
                            data: 'v_harga_makanan',
                        },
                        {
                            data: 'v_jarak',
                        },
                        {
                            data: 'v_fasilitas',
                        },
                        {
                            data: 'v_jam_operasional',
                        },
                        {
                            data: 'v_variasi_makan',
                        },
                        {
                            data: 'action',
                        },
                    ],
                });


                $('#ranking_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 10,
                    ajax: {
                        url: "{{ route('data.ranking.v2') }}",
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
                            data: 'name',
                        },
                        {
                            data: 'v_harga_makanan',
                            className: 'text-end',
                        },
                        {
                            data: 'v_jarak',
                            className: 'text-end',
                        },
                        {
                            data: 'v_fasilitas',
                            className: 'text-end',
                        },
                        {
                            data: 'v_jam_operasional',
                            className: 'text-end',
                        },
                        {
                            data: 'v_variasi_makanan',
                            className: 'text-end',
                        },
                        {
                            data: 'jumlah',
                            className: 'text-end',
                        },
                    ],
                });

                $('#normalisasi_table').DataTable({
                    processing: true,
                    serverSide: true,
                    "iDisplayLength": 50,
                    ajax: {
                        url: "{{ route('data.normalisasi.v2') }}",
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
                            data: 'restaurant',
                        },
                        {
                            data: 'v_harga_makanan',
                        },
                        {
                            data: 'v_jarak',
                        },
                        {
                            data: 'v_fasilitas',
                        },
                        {
                            data: 'v_jam_operasional',
                        },
                        {
                            data: 'variasi_makanan',
                        },
                    ],
                });
            });

            $('#back').on('click', function(){
                $('#edit-modal').modal('hide');
            });

            function updateItem(e) {
                let id = e.getAttribute('data-id');

                $.ajax({
                    type: 'GET',
                    url: 'edit-bobot-user/' + id + '/edit',
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
            };

            function deleteItem(e) {
                let id = e.getAttribute('data-id');
                let name = e.getAttribute('data-name');

                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Ingin menghapus " + name + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'DELETE',
                            url:  'destroy-alternatif-user/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (response) {
                                if (response.success == true) {
                                    toastr.success(response.message);
                                    var oTable = $('#alternatif_table').DataTable(); //inialisasi datatable
                                    oTable.ajax.reload(); //reset datatable
                                }
                            }
                        })
                    }
                })
            }
        </script>
    @endsection
@endsection
