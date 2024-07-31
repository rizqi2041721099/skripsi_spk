@extends('layouts.main-content')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Alternatif</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('alternatif.index') }}">Data Alternatif</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Data Alternatif</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Edit Data Alternatif
                </h6>
            </div>
            <div class="card-body">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Catatan</strong> Nilai minimum 0 dan maksimum 100, Gunakan (.) jika input desimal!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_alternatif">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                       <div class="col-md-12 mt-2">
                            <label for="restaurant">Restaurant</label>
                            <select  class="select2-single form-control"
                            data-toggle="select" id="restaurant" name="restaurant_id" width="100%" aria-readonly="true" disabled>
                                @foreach ($restaurant as $item)
                                    <option value="{{ $item->id }}" {{ $data->restaurant_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="error_restaurant_id"></small>
                       </div>
                       <div class="col-md-12 mt-2">
                            <label class="form-label">Harga Makanan</label>
                            <input type="text" class="form-control" id="v_harga_makanan" name="v_harga_makanan" value="{{ $data->v_harga_makanan }}">
                            <small class="text-danger" id="error_v_harga_makanan"></small>
                       </div>
                       <div class="col-md-12 mt-2">
                            <label class="form-label">Jarak</label>
                            <input type="text" class="form-control" id="v_jarak" name="v_jarak" value="{{ $data->v_jarak }}">
                            <small class="text-danger" id="error_v_jarak"></small>
                       </div>
                       <div class="col-md-12 mt-2">
                            <label class="form-label">Fasilitas</label>
                            <input type="text" class="form-control" id="v_fasilitas" name="v_fasilitas" value="{{ $data->v_fasilitas }}">
                            <small class="text-danger" id="error_v_fasilitas"></small>
                       </div>
                       <div class="col-md-12 mt-2">
                            <label class="form-label">Jam Operasional</label>
                            <input type="text" class="form-control" id="v_rasa_makanan" name="v_rasa_makanan" value="{{ $data->v_rasa_makanan }}">
                            <small class="text-danger" id="error_v_rasa_makanan"></small>
                       </div>
                       <div class="col-md-12 mt-2">
                            <label class="form-label">Variasi Menu</label>
                            <input type="text" class="form-control" id="v_variasi_makanan" name="v_variasi_makanan" value="{{ $data->v_variasi_makanan }}">
                            <small class="text-danger" id="error_v_variasi_makanan"></small>
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Kembali</a>
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
                // ajax: {
                //     url: "{{ route('get-restaurant') }}",
                //     dataType: 'json',
                //     type: "POST",
                //     delay: 250,
                //     data: function(params) {
                //         return {
                //             "_token": "{{ csrf_token() }}",
                //             search: params.term // search term
                //         };
                //     },
                //     processResults: function(response) {
                //         return {
                //             results: response
                //         };
                //     },
                //     cache: false
                // }
            });

            $('#form_alternatif').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('alternatif.update', $data->id) }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            window.location.href = "{{ route('alternatif.index') }}";
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
                        $('#error_v_harga_makanan').text(response.responseJSON.errors.v_harga_makanan);
                        $('#error_v_rasa_makanan').text(response.responseJSON.errors.v_rasa_makanan);
                        $('#error_v_variasi_makanan').text(response.responseJSON.errors.v_variasi_makanan);
                        $('#error_jarak').text(response.responseJSON.errors.jarak);
                        $('#error_fasilitas').text(response.responseJSON.errors.fasilitas);
                    }
                });
            });
        });

    </script>
@endsection
