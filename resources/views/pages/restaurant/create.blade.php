@extends('layouts.main-content')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Restaurant</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="#">Tambah Restaurant</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Tambah Restaurant
                </h6>
            </div>
            <div class="card-body">
                <form id="form-create" name="form-tambah">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Restaurant Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                            <small class="text-danger" id="error_name"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address">
                            <small class="text-danger" id="error_address"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Distance <span class="text-danger">Input Jarak format angka (m)*</span></label>
                            <input type="text" class="form-control" id="distance" name="distance">
                            <small class="text-danger" id="error_distance"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Facility</label>
                            <input type="text" class="form-control" id="facility" name="facility">
                            <small class="text-danger" id="error_facility"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Qty Food Variety</label>
                            <input type="text" class="form-control" id="qty_variasi_makanan" name="qty_variasi_makanan">
                            <small class="text-danger" id="error_qty_variasi_makanan"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Rata-Rata Harga Makanan</label>
                            <input type="text" class="form-control" data-type="currency" id="average"
                            name="average" value="0">
                            <small class="text-danger" id="error_average"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="images" id="foto">
                            <img id="imagePreview" class="img-preview mt-3" style="display: none;" width="150" height="150" />
                        </div>
                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
                        <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#form-create').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('restaurants.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            window.location.href = "{{ route('restaurants.create') }}";
                            sessionStorage.setItem('success', response.message);
                        } else if (response.success == false) {
                            btn.attr('disabled', false);
                            btn.text('Submit');
                            toastr.error('error', response.message);
                        }
                    },
                    error: function(response) {
                        btn.attr('disabled', false);
                        btn.text('Submit');
                        $('#error_name').text(response.responseJSON.errors.name);
                        $('#error_distance').text(response.responseJSON.errors.distance);
                        $('#error_images').text(response.responseJSON.errors.images);
                        $('#error_address').text(response.responseJSON.errors.address);
                        $('#error_facility').text(response.responseJSON.errors.facility);
                        $('#error_average').text(response.responseJSON.errors.average);
                    }
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
        });

    </script>
@endsection
