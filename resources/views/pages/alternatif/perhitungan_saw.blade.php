@extends('layouts.main-content')
@section('title','Perhitungan SAW')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Perhitungan SAW</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Perhitungan SAW</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Normalisasi Alternatif</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-bordered mb-4">
                        <tr>
                            <th>Kategori</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Benefit</th>
                            <th scope="col">Benefit</th>
                            <th scope="col">Benefit</th>
                        </tr>
                        <tr>
                            <th scope="row">Nilai Pembagi</th>
                            <td>{{ $min_v_harga_makanan }}</td>
                            <td>{{ $min_v_jarak }}</td>
                            <td>{{ $max_v_fasilitas }}</td>
                            <td>{{ $max_v_rasa_makanan }}</td>
                            <td>{{ $max_v_variasi_makanan }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Bobot</th>
                            <td>0.30</td>
                            <td>0.25</td>
                            <td>0.25</td>
                            <td>0.10</td>
                            <td>0.10</td>
                        </tr>
                    </table>
                    <table class="table table-bordered" width="100%" id="alternatif_table">
                        <thead>
                            <tr>
                                <th rowspan="2" width="15%">No</th>
                                <th rowspan="2" width="15%">Restaurant</th>
                                <th colspan="5" class="text-center">Kriteria</th>
                            </tr>
                            <tr>
                                <th>Harga Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                                <th>Rasa Makanan</th>
                                <th>Variasi Menu</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="2">Bobot</th>
                                <th id="sum_v_harga">0.30</th>
                                <th id="sum_v_jarak">0.25</th>
                                <th id="sum_v_fasilitas">0.25</th>
                                <th id="sum_v_rasa">0.10</th>
                                <th id="sum_v_variasi">0.10</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="my-5">
                        <h6 class="text-primary font-weight-bold">Normalisasi Alternatif Restaurant / Tempat Makan</h6>
                        <table class="table table-bordered mb-4">
                            <tr>
                                <th>Kategori</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Benefit</th>
                                <th scope="col">Benefit</th>
                                <th scope="col">Benefit</th>
                            </tr>
                            <tr>
                                <th scope="row">Nilai Pembagi</th>
                                <td>{{ $min_v_harga_makanan }}</td>
                                <td>{{ $min_v_jarak }}</td>
                                <td>{{ $max_v_fasilitas }}</td>
                                <td>{{ $max_v_rasa_makanan }}</td>
                                <td>{{ $max_v_variasi_makanan }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Bobot</th>
                                <td>0.30</td>
                                <td>0.25</td>
                                <td>0.25</td>
                                <td>0.10</td>
                                <td>0.10</td>
                            </tr>
                        </table>
                        <table class="table table-bordered" width="100%" id="normalisasi_table">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="15%">No</th>
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
                            <tfoot>
                                <tr>
                                    <th>No</th>
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
                    <div class="my-5">
                        <h6 class="text-primary font-weight-bold">Data Ranking Restaurant / Tempat Makan</h6>
                        <table class="table table-bordered" width="100%" id="data_ranking_table">
                            <thead>
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
                                    <th>Rasa Makanan</th>
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
                                    <th>Rasa Makanan</th>
                                    <th>Variasi Makanan</th>
                                    <th>Jumlah</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script type="application/javascript">
    $(document).ready(function () {
        $('#alternatif_table').DataTable({
            processing: true,
            serverSide: true,
            "iDisplayLength": 50,
            ajax: {
                url: "{{ route('perhitungan.saw') }}",
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
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'v_variasi_makan',
                },
            ],

            // "footerCallback": function(row, data, start, end, display) {
            //         var api = this.api();

            //         sum_v_harga = api
            //             .column(2)
            //             .data()
            //             .reduce(function(a, b) {
            //                 return parseFloat(a) + parseFloat(b);
            //             }, 0);
            //         $('#sum_v_harga').html(sum_v_harga);

            //         sum_v_variasi = api
            //             .column(3)
            //             .data()
            //             .reduce(function(a, b) {
            //                 return parseFloat(a) + parseFloat(b);
            //             }, 0);
            //         $('#sum_v_variasi').html(sum_v_variasi);

            //         var sum_v_rasa = api
            //             .column(4)
            //             .data()
            //             .toArray();
            //         var totalSum = sum_v_rasa.reduce(function(total, num) {
            //             return total + parseFloat(num);
            //         }, 0);
            //         $('#sum_v_rasa').html(totalSum);

            //         sum_v_jarak = api
            //             .column(5)
            //             .data()
            //             .reduce(function(a, b) {
            //                 return parseFloat(a) + parseFloat(b);
            //             }, 0);
            //         $('#sum_v_jarak').html(sum_v_jarak);

            //         sum_v_fasilitas = api
            //             .column(6)
            //             .data()
            //             .reduce(function(a, b) {
            //                 return parseFloat(a) + parseFloat(b);
            //             }, 0);
            //         $('#sum_v_fasilitas').html(sum_v_fasilitas);

            //     }
        });

        $('#normalisasi_table').DataTable({
            processing: true,
            serverSide: true,
            "iDisplayLength": 50,
            ajax: {
                url: "{{ route('normalisasi.alternatif') }}",
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
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'variasi_makanan',
                },
            ],
        });

        function getSum(total, num) {
           return total + Math.round(num);
        }

        $('#data_ranking_table').DataTable({
            processing: true,
            serverSide: true,
            "iDisplayLength": 50,
            ajax: {
                url: "{{ route('data.ranking') }}",
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
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'v_variasi_makanan',
                },
                {
                    data: 'jumlah',
                },
            ],
        });
    });
</script>
@endsection
