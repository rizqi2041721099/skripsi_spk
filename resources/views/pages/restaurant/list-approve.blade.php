@extends('layouts.main-content')
@section('title','List Approve Restaurants')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List Approve Restaurants</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">List Approve Restaurants</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Approve Restaurants</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="list_approve_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Jarak</th>
                                <th>Image</th>
                                <th>Fasilitas</th>
                                <th>Qty Variasi Makanan</th>
                                <th>Rata-Rata Harga Makanan</th>
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
                                <th>Fasilitas</th>
                                <th>Qty Variasi Makanan</th>
                                <th>Rata-Rata Harga Makanan</th>
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
        $('#list_approve_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('list.approve') }}",
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
                    data: 'action',
                },
            ],
        });
    });

    function approve(e){
        let id = e.getAttribute('data-id');
        let name = e.getAttribute('data-name');
        let status = e.getAttribute('data-status');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        });
        swalWithBootstrapButtons.fire({
        title: 'Apa anda yakin?',
        text: name+"?",
        icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                if(status == 'N'){
                    Swal.fire({
                        title: "Note",
                        // text: "",
                        input: 'text',
                        showCancelButton: true
                    }).then((result) =>{
                        if (result.value) {
                            if(result.value == ''){
                                toastr.error('warning','note harus diisi')
                            }else{
                                $.ajax({
                                    type:'POST',
                                    url:"/approve-restaurant/"+id,
                                    data:{
                                        "_token": "{{ csrf_token() }}",
                                        "_method": 'GET',
                                        "status":status,
                                        "note":result.value
                                    },
                                    success:function(data) {
                                        if (data.code == 200) {
                                            toastr.success(data.message);
                                            var oTable = $('#list_approve_table')
                                                .DataTable();
                                            oTable.ajax.reload();
                                        } else if (data.code == 400) {
                                            toastr.error('error', data.message);
                                        }
                                    }
                                });
                            }
                        }
                    })
                }else{
                    if (result.isConfirmed){
                        $.ajax({
                            type:'POST',
                            url:"/approve-restaurant/"+id,
                            data:{
                                "_token": "{{ csrf_token() }}",
                                "_method": 'GET',
                                "status":status,
                            },
                            success:function(data) {
                                if (data.code == 200) {
                                    toastr.success(data.message);
                                    var oTable = $('#list_approve_table')
                                        .DataTable();
                                    oTable.ajax.reload();
                                } else if (data.code == 400) {
                                    toastr.error('error', data.message);
                                }
                            }

                        });
                    }
                }
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
            swal.fire(
                'Cancelled',
                'error'
            )
            }
        });
    }
</script>
@endsection
