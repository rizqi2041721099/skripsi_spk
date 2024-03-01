@extends('layouts.main-content')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Fasilitas</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="{{ route('facilities.index') }}">Fasilitas</a></li>
                <li class="breadcrumb-item active"><a href="#">Tambah Fasilitas</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Tambah Fasilitas
                </h6>
            </div>
            <div class="card-body">
                <form id="facilities_table">
                    @csrf
                    <div class="row mb-3">
                       <div class="col-md-4">
                            <label for="restaurant">Restaurant</label>
                            <select  class="select2-single form-control"
                            data-toggle="select" id="restaurant" name="restaurant_id" width="100%"></select>
                            <small class="text-danger" id="error_restaurant_id"></small>
                       </div>
                       <div class="col-md-4">
                            <label class="form-label">Fasilitas</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                            <small class="text-danger" id="error_name"></small>
                       </div>
                       <div class="col-md-4">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image" id="foto">
                            <img id="imagePreviewEdit" class="img-preview mt-3" style="display: none; mar" width="150" height="150" />
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" id="submit-button" class="btn btn-primary"
                                data-loading-text="Loading...">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

            $('#facilities_table').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('facilities.update', $data->id) }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            window.location.href = "{{ route('facilities.index') }}";
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
                        $('#error_restaurant_id').text(response.responseJSON.errors.restaurant_id);
                        $('#error_name').text(response.responseJSON.errors.name);
                        $('#error_image').text(response.responseJSON.errors.image);
                    }
                });
            });

            $('#foto_edit').empty();

            $('#foto_edit').change(function() {
                var file = this.files[0];

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreviewEdit').attr('src',  "{{ Storage::url('public/images/facilities/') }}" + '/' + "{{ $data->images }}");
                        $('#imagePreviewEdit').show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

    </script>
@endsection
