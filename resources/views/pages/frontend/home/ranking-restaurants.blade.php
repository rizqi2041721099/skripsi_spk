@extends('layouts.frontend.app-detail')
@section('title-head')
    Ranking
@endsection
@section('list')
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Ranking Restaurants</li>
    </ol>
@endsection
@section('content')
    <div class="container-xxl py-5" id="about-us">
        <div class="container">
            <div class="row g-5 align-items-center">
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
    <script type="application/javascript">
        $(document).ready(function () {
            $('#ranking_table').DataTable({
                processing: true,
                serverSide: true,
                "iDisplayLength": 10,
                ajax: {
                    url: "{{ route('ranking.restaurants') }}",
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
        });
    </script>
@endsection
