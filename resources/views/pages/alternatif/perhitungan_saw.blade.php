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
                            <th scope="col">Benefit</th>
                            <th scope="col">Benefit</th>
                            <th scope="col">Cost</th>
                            <th scope="col">Benefit</th>
                        </tr>
                        <tr>
                            <th scope="row">Nilai Pembagi</th>
                            <td>1</td>
                            <td>5</td>
                            <td>5</td>
                            <td>1</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <th scope="row">Bobot</th>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
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
                                <th>Variasi Makanan</th>
                                <th>Rasa Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Restaurant</th>
                                <th>Harga Makanan</th>
                                <th>Variasi Makanan</th>
                                <th>Rasa Makanan</th>
                                <th>Jarak</th>
                                <th>Fasilitas</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="my-5">
                        <h6 class="text-primary font-weight-bold">Normalisasi Alternatif Restaurant / Tempat Makan</h6>
                        <table class="table table-bordered mb-4">
                            <tr>
                                <th>Kategori</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Benefit</th>
                                <th scope="col">Benefit</th>
                                <th scope="col">Cost</th>
                                <th scope="col">Benefit</th>
                            </tr>
                            <tr>
                                <th scope="row">Nilai Pembagi</th>
                                <td>1</td>
                                <td>5</td>
                                <td>5</td>
                                <td>1</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <th scope="row">Bobot</th>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </table>
                        <table class="table table-bordered" width="100%" id="normalisasi_alternatif_table">
                            <thead>
                                <tr>
                                    <th rowspan="2" width="15%">No</th>
                                    <th rowspan="2" width="15%">Restaurant</th>
                                    <th colspan="5" class="text-center">Kriteria</th>
                                </tr>
                                <tr>
                                    <th>Harga Makanan</th>
                                    <th>Variasi Makanan</th>
                                    <th>Rasa Makanan</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Restaurant</th>
                                    <th>Harga Makanan</th>
                                    <th>Variasi Makanan</th>
                                    <th>Rasa Makanan</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
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
                                    <th>Variasi Makanan</th>
                                    <th>Rasa Makanan</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Restaurant</th>
                                    <th>Harga Makanan</th>
                                    <th>Variasi Makanan</th>
                                    <th>Rasa Makanan</th>
                                    <th>Jarak</th>
                                    <th>Fasilitas</th>
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
                    data: 'v_variasi_makanan',
                },
                {
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'v_jarak',
                },
                {
                    data: 'v_fasilitas',
                },
            ],
        });

        $('#normalisasi_alternatif_table').DataTable({
            processing: true,
            serverSide: true,
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
                    data: 'variasi_makanan',
                },
                {
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'v_jarak',
                },
                {
                    data: 'v_fasilitas',
                },
            ],
        });

        $('#data_ranking_table').DataTable({
            processing: true,
            serverSide: true,
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
                    data: 'v_variasi_makanan',
                },
                {
                    data: 'v_rasa_makanan',
                },
                {
                    data: 'v_jarak',
                },
                {
                    data: 'v_fasilitas',
                },
                {
                    data: 'jumlah',
                },
            ],
        });
    });
</script>
@endsection
