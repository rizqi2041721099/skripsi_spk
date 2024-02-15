@extends('layouts.main-content')
@section('title','Roles')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Management Roles</a></li>
            <li class="breadcrumb-item active" aria-current="page">Roles</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Roles</h6>
                    <a class="btn btn-sm btn-success text-white" href="{{ route('roles.create') }}" style="cursor: pointer"
                        id="add-btn"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="role_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
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
        $('#role_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('roles.index') }}",
                type: 'GET'
            },
            "responsive": true,
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
                    data: 'action',
                },
            ],
        });

    });


    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let role = e.getAttribute('data-name');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Ingin menghapus role " + role + " ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url:  'roles/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            var oTable = $('#role_table').DataTable(); //inialisasi datatable
                            oTable.ajax.reload(); //reset datatable
                        }
                    }
                })
            }
        })
    }

</script>
@endsection
