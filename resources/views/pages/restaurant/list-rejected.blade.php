@extends('layouts.main-content')
@section('title','List Rejected Restaurants')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Rejected Restaurants</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">List Rejected Restaurants</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Rejected Restaurants</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="list_rejected_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jarak</th>
                                <th>Image</th>
                                <th>Qty Fasilitas</th>
                                <th>Qty Variasi Makanan</th>
                                <th>Rata-Rata Harga Makanan</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jarak</th>
                                <th>Image</th>
                                <th>Qty Fasilitas</th>
                                <th>Qty Variasi Makanan</th>
                                <th>Rata-Rata Harga Makanan</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
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
        $('#list_rejected_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('list.rejected') }}",
                type: 'GET',
            },
            "responsive": false,
            "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ],
            "language": {
                "oPaginate": {
                    "sNext": "<i class='fas fa-angle-right'>",
                    "sPrevious": "<i class='fas fa-angle-left'>",
                },
                // processing: '<img src="{{ asset('img/loader/loader3.gif') }}">',
            },
            columns: [{
                    data: 'DT_RowIndex',
                },
                {
                    data: 'name',
                },
                {
                    data: 'address',
                },
                {
                    data: 'distance',
                },
                {
                    data: 'image',
                },
                {
                    data: 'facility',
                },
                {
                    data: 'qty_variasi_makanan',
                },
                {
                    data: 'average',
                },
                {
                    data: 'note',
                },
                {
                    data: 'action',
                },
            ],
        });
    });
</script>
@endsection
