@extends('layouts.main-content')
@section('title','Restaurants')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Restaurants</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Restaurants</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Restaurants</h6>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)" style="cursor: pointer"
                        id="add-btn"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="restaurants_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Restoran</th>
                                <th>Alamat</th>
                                <th>Jarak</th>
                                <th>Image</th>
                                <th>Fasilitas</th>
                                <th>Jumlah Variasi Makanan</th>
                                <th>Rata-Rata Harga Makanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Restoran</th>
                                <th>Alamat</th>
                                <th>Jarak</th>
                                <th>Image</th>
                                <th>Fasilitas</th>
                                <th>Jumlah Variasi Makanan</th>
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
        $('#restaurants_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('restaurants.index') }}",
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


        $('#add-btn').click(function () {
            $('#form-create').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Restaurant");
            $('#create-modal').modal('show'); //
        });


        $("#form-create").on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('restaurants.store')}}",
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
                        var oTable = $('#restaurants_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_name').text(response.responseJSON.errors.name);
                    $('#error_distance').text(response.responseJSON.errors.distance);
                    $('#error_facility').text(response.responseJSON.errors.facility);
                    $('#error_image').text(response.responseJSON.errors.image);
                },
            });
        });

        $('#form-edit').on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            let id = $('#id').val();

            $.ajax({
                url: 'restaurants/' + id,
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
                        var oTable = $('#restaurants_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_edit_name').text(response.responseJSON.errors.name);
                    $('#error_edit_distance').text(response.responseJSON.errors.distance);
                    $('#error_edit_facility').text(response.responseJSON.errors.facility);
                    $('#error_edit_image').text(response.responseJSON.errors.image);
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
            url:  '/restaurants/' + id + '/edit',
            success: function (response) {
                $('#id').val(response.id);
                $('#edit_name').val(response.name);
                $('#edit_address').val(response.address);
                $('#edit_distance').val(response.distance);
                $('#edit_facility').val(response.facility);
                $('#edit_average').val(response.average);
                $('#edit_qty_variasi_makanan').val(response.qty_variasi_makanan);
                var image = response.images;
                $('#imagePreviewEdit').attr('src', "{{ Storage::url('public/images/restaurants/') }}" + '/' + image);
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
                    url:  'restaurants/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            var oTable = $('#restaurants_table').DataTable(); //inialisasi datatable
                            oTable.ajax.reload(); //reset datatable
                        }
                    }
                })
            }
        })
    }

</script>
@endsection
