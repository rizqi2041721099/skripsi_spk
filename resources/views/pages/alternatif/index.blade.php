@extends('layouts.main-content')
@section('title','Alternatif')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Alternatif</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Alternatif</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Alternatif</h6>
                    <a class="btn btn-sm btn-success text-white" href="{{ route('alternatif.create') }}" style="cursor: pointer"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table table-bordered" width="100%" id="alternatif_table">
                        <thead>
                            <tr>
                                <th rowspan="2" width="15%">No</th>
                                <th rowspan="2" width="15%">Restaurant</th>
                                <th colspan="5" class="text-center">Kriteria</th>
                                <th rowspan="2" width="15%">Action</th>
                            </tr>
                            <tr>
                                <th data-dt-order="disable" width="15%">Harga Makanan</th>
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
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
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
                url: "{{ route('alternatif.index') }}",
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
                    data: 'action',
                },
            ],
        });
    });

    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let user = e.getAttribute('data-name');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Ingin menghapus " + user + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url:  'alternatif/' + id,
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
