@extends('layouts.main-content')
@section('title','Users')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Management Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Users</h6>
                    <a class="btn btn-sm btn-success text-white" href="{{ route('users.create') }}" style="cursor: pointer"
                        id="add-btn"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                </div>
                <div class="row m-2">
                    <div class="col-md-3">
                        <label for="">Nama</label>
                        <select  class="select2-single form-control"
                        data-toggle="select" id="users"></select>
                    </div>
                    <div class="mt-auto">
                        <button type="button" name="filter" id="filter" class="btn btn-primary">Cari</button>
                        <button type="button" name="reset" id="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="users_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Role</th>
                                <th>Email</th>
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
        $('#users').select2({
            placeholder: "cari user",
            allowClear: true,
            ajax: {
                url: "{{ route('get.users') }}",
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

        fill_datatable();

        function fill_datatable(filter_name = '') {
            $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                    data: {
                        filter_name: filter_name,
                    }
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
                        data: 'role',
                    },
                    {
                        data: 'email',
                    },
                    {
                        data: 'action',
                    },
                ],
            });
        }
        $('#filter').click(function() {
            var filter_name = $('#filter_name').val();

            if (filter_name != '') {
                $('#users_table').DataTable().destroy();
                fill_datatable(filter_name);
            } else {
                toastr.warning('warning', 'Input name terlebih dahulu!');
            }
        });

        $('#reset').click(function() {
            $('#filter_name').val();
            $('#users_table').DataTable().destroy();
            fill_datatable();
        });
    });


    function deleteItem(e) {
        let id = e.getAttribute('data-id');
        let user = e.getAttribute('data-name');

        Swal.fire({
            title: 'Anda yakin?',
            text: "Ingin menghapus user " + user + "?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url:  'users/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            var oTable = $('#users_table').DataTable(); //inialisasi datatable
                            oTable.ajax.reload(); //reset datatable
                        }
                    }
                })
            }
        })
    }

</script>
@endsection
