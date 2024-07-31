@extends('layouts.main-content')
@section('title','Bobot Kriteria')
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Bobot Kriteria</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Bobot Kriteria</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Bobot Kriteria</h6>
                    @php
                        $data = App\Models\BobotKriteria::count();
                    @endphp
                    @if ($data < 1)
                        <a class="btn btn-sm btn-success text-white" href="javascript:void(0)" style="cursor: pointer"
                        id="add-btn"> <span><i class="fa fa-plus"></i>&nbsp;Tambah </span> </a>
                    @endif
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" width="100%" id="bobot_kriteria_table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Harga Makanan</th>
                                <th>Bobot Jarak</th>
                                <th>Fasilitas</th>
                                <th>Jam Operasional</th>
                                <th>Variasi Menu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Harga Makanan</th>
                                <th>Bobot Jarak</th>
                                <th>Fasilitas</th>
                                <th>Jam Operasional</th>
                                <th>Variasi Menu</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('pages.bobot-kriteria.modal')
</div>
<script type="application/javascript">
    $(document).ready(function () {
        $('#bobot_kriteria_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('bobot-kriteria.index') }}",
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
                    data: 'b_harga_makanan',
                },
                {
                    data: 'b_jarak',
                },
                {
                    data: 'b_fasilitas',
                },
                {
                    data: 'b_jam_operasional',
                },
                {
                    data: 'b_variasi_menu',
                },
                {
                    data: 'action',
                },
            ],
        });


        $('#add-btn').click(function () {
            $('#form-create').trigger("reset"); //mereset semua input dll didalamnya
            $('#modal-judul').html("Tambah Bobot Kriteria");
            $('#create-modal').modal('show'); //
        });


        $("#form-create").on('submit', function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('bobot-kriteria.store')}}",
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
                        var oTable = $('#bobot_kriteria_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_bobot_harga_makanan').text(response.responseJSON.errors.bobot_harga_makanan);
                    $('#error_bobot_harga_jarak').text(response.responseJSON.errors.bobot_harga_jarak);
                    $('#error_bobot_harga_fasilitas').text(response.responseJSON.errors.bobot_harga_fasilitas);
                    $('#error_bobot_rasa_makan').text(response.responseJSON.errors.bobot_rasa_makan);
                    $('#error_bobot_variasi_menu').text(response.responseJSON.errors.bobot_variasi_menu);
                },
            });
        });

        $('#form-edit').on('submit', function (event) {
            event.preventDefault();
            let formData = new FormData(this);
            let id = $('#id').val();

            $.ajax({
                url: 'bobot-kriteria/' + id,
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
                        var oTable = $('#bobot_kriteria_table').DataTable(); //inialisasi datatable
                        oTable.ajax.reload(); //reset datatable
                    } else if(response.success == false) {
                        toastr.error(response.message);
                    }
                },
                error: function (response) {
                    $('#error_edit_bobot_harga_makanan').text(response.responseJSON.errors.bobot_harga_makanan);
                    $('#error_edit_bobot_harga_jarak').text(response.responseJSON.errors.bobot_harga_jarak);
                    $('#error_edit_bobot_harga_fasilitas').text(response.responseJSON.errors.bobot_harga_fasilitas);
                    $('#error_edit_bobot_rasa_makan').text(response.responseJSON.errors.bobot_rasa_makan);
                    $('#error_edit_bobot_variasi_menu').text(response.responseJSON.errors.bobot_variasi_menu);
                },
            });
        })
    });

    function updateItem(e) {
        let id = e.getAttribute('data-id');

        $.ajax({
            type: 'GET',
            url:  'bobot-kriteria/' + id + '/edit',
            success: function (response) {
                $('#id').val(response.id);
                $('#edit_bobot_harga_makanan').val(response.bobot_harga_makanan);
                $('#edit_bobot_jarak').val(response.bobot_jarak);
                $('#edit_bobot_fasilitas').val(response.bobot_fasilitas);
                $('#edit_bobot_jam_operasional').val(response.bobot_jam_operasional);
                $('#edit_bobot_variasi_menu').val(response.bobot_variasi_menu);
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
                    url:  'bobot-kriteria/' + id,
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function (response) {
                        if (response.success == true) {
                            toastr.success(response.message);
                            var oTable = $('#bobot_kriteria_table').DataTable(); //inialisasi datatable
                            oTable.ajax.reload(); //reset datatable
                        }
                    }
                })
            }
        })
    }

</script>
@endsection
