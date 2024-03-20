@extends('layouts.main-content')
@section('title','Facilities')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Facilities</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Master</a></li>
            <li class="breadcrumb-item active" aria-current="page">Facilities</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Facilities</h6>
                    <a class="btn btn-sm btn-success text-white" href="{{ route('facilities.create') }}"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="facilties_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Fasilitas</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Fasilitas</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.facilities.modal')
</div>
<script type="application/javascript">
    $(document).ready(function () {
        $('#restaurant').select2({
            placeholder: "cari restaurant",
            allowClear: true,
            ajax: {
                url: "{{ route('get-restaurant') }}",
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

        $('#facilties_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('facilities.index') }}",
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
                    data: 'image',
                },
                {
                    data: 'action',
                },
            ],
        });


        $('#add-btn').click(function () {
            $('#form-create').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Variasi Makanan");
            $('#create-modal').modal('show'); //
        });


        $("#form-create").on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('facilities.store')}}",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        toastr.success(response.message);
                        $("#form-create")[0].reset();
                        $('#create-modal').modal('hide'); //modal hide
                        var oTable = $('#facilties_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_name').text(response.responseJSON.errors.name);
                    $('#error_image').text(response.responseJSON.errors.image);
                },
            });
        });

        $('#form-edit').on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            let id = $('#id').val();

            $.ajax({
                url: 'facilities/' + id,
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
                        var oTable = $('#facilties_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_edit_name').text(response.responseJSON.errors.name);
                },
            });
        });

        $('#foto').empty();

        $('#foto').change(function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').show();
                };
                reader.readAsDataURL(file);
            }
        });

        $('#foto_edit').empty();

        $('#foto_edit').change(function() {
            var file = this.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreviewEdit').attr('src', e.target.result);
                    $('#imagePreviewEdit').show();
                };
                reader.readAsDataURL(file);
            }
        });
    });

    function updateItem(e) {
        let id = e.getAttribute('data-id');
        let image = e.getAttribute('dataa-image');
        let name = e.getAttribute('data-name');

        $.ajax({
            type: 'GET',
            url:  '/facilities/' + id + '/edit',
            success: function (response) {
                $('#id').val(response.id);
                $('#edit_name').val(response.name);
                var image = response.image;
                $('#imagePreviewEdit').attr('src', "{{ Storage::url('public/images/facilities/') }}" + '/' + image);
                $('#edit-modal').modal('show');
            }
        })
    }

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
                    url:  'facilities/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            var oTable = $('#facilties_table').DataTable(); //inialisasi datatable
                            oTable.ajax.reload(); //reset datatable
                        }
                    }
                })
            }
        })
    }

</script>
@endsection
