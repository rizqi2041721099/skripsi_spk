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
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Nama Restuarant <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="restaurant_name">
                            <small class="text-danger" id="error_restaurant_name"></small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Alamat <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address">
                            <small class="text-danger" id="error_address"></small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jarak <span class="text-danger">Tambahkan format KM jika < 1 KM (0.5 KM) *</span></label>
                            <input type="text" class="form-control" id="distance" name="distance" placeholder="Exp: 1 KM / 0.5 KM">
                            <small class="text-danger" id="error_distance"></small>
                        </div>
                        {{-- <div class="col-md-4 mb-3">
                            <label class="form-label">Jumlah Variasi Menu <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="qty_variasi_makanan" name="qty_variasi_makanan">
                            <small class="text-danger" id="error_qty_variasi_makanan"></small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Rata-Rata Harga Makanan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" data-type="currency" id="average"
                            name="average" value="0">
                            <small class="text-danger" id="error_average"></small>
                        </div> --}}
                        <div class="col-md-4 mb-3">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="image" id="foto">
                            <img id="imagePreview" class="img-preview mt-3" style="display: none;" width="150" height="150" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Link Gmaps</label>
                            <input type="text" class="form-control" name="map_link">
                            <small class="text-danger" id="error_map_link"></small>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Kriteria Fasilitas <span class="text-danger">*</span></label>
                            <select name="kriteria_fasilitas_id" id="kriteria_fasilitas_id" class="form-control">
                                <option value="">pilih</option>
                                @foreach ($getFasilitas as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value }}</option>
                                @endforeach
                            </select>
                            <small class="text-danger" id="error_kriteria_fasilitas_id"></small>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Kriteria Rasa <span class="text-danger">*</span></label>
                            <select name="kriteria_rasa_id" id="kriteria_rasa_id" class="form-control">
                                <option value="">pilih</option>
                                @foreach ($getRasa as $item)
                                    <option value="{{ $item->id }}">{{ $item->standard_value }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <h6>Variasi Menu <span class="text-danger">*</span></h6>
                    <div id="menu-container">
                        <div class="row  mb-3">
                            <div class="col-md-4">
                                <label for="">Nama Menu</label>
                                <input type="text" class="form-control" name="name[]">
                            </div>
                            <div class="col-md-4">
                                <label for="">Harga</label>
                                <input type="text" class="form-control" name="price[]" data-type="currency" value="0">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button class="btn btn-md btn-primary" id="add-row" type="button"><i
                                    class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row ml-3">
                        <h6>Fasilitas <span class="text-danger">*</span> :</h6>
                        <hr>
                        @foreach ($facilities as $item)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <table class="table-hover">
                                    <tr>
                                        <td class="align-top">
                                            <div class="form-check">
                                                <input type="checkbox" name="facility_id[]"
                                                    value="{{ $item->id }}"
                                                    id="facility_{{ $item->id }}"
                                                    class="form-check-input">
                                            </div>
                                        </td>
                                        <td class="align-middle">
                                            <div class="form-group">
                                                <label class="form-check-label">
                                                    {{ $item->name }}
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('restaurants.index') }}" class="btn btn-light">Kembali</a>
                        <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            $('#menu-container').on('click', '.delete-row', function() {
                $(this).closest('.row').remove();
            });

            $('#menu-container').on('click', '#add-row', function() {
                var row = '<div class="row mb-3">' +
                    '<div class="col-md-4">' +
                    '<label for="">Nama Menu</label>' +
                    '<input type="text" class="form-control" name="name[]">' +
                    '</div>' +
                    '<div class="col-md-4">' +
                    '<label for="">Harga</label>' +
                    '<input type="text" class="form-control price-input" name="price[]" data-type="currency" value="0">' +
                    '</div>' +
                    '<div class="col-md-4 d-flex align-items-end">' +
                    '<button class="btn btn-md btn-danger delete-row"><i class="fas fa-trash"></i></button>' +
                    '</div>' +
                    '</div>';

                $('#menu-container').append(row);
                $('.price-input').each(function() {
                    var cleave = new Cleave(this, {
                        numeral: true,
                        numeralThousandsGroupStyle: 'thousand'
                    });
                });
            });



            $('#form-create').on('submit', function(event) {
                event.preventDefault();
                // Mengumpulkan data dari input dinamis
                var menuData = [];
                $('[name="name[]"]').each(function(index) {
                    var name = $(this).val();
                    var price = $('[name="price[]"]').eq(index).val();
                    menuData.push({ name: name, price: price });
                });

                var formData = new FormData(this);

                formData.append('menuData', JSON.stringify(menuData));

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
                            window.location.href = "{{ route('restaurants.index') }}";
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
                        $('#error_restaurant_name').text(response.responseJSON.errors.restuarnt_name);
                        $('#error_distance').text(response.responseJSON.errors.distance);
                        $('#error_images').text(response.responseJSON.errors.images);
                        $('#error_address').text(response.responseJSON.errors.address);
                        $('#error_facility').text(response.responseJSON.errors.facility);
                        // $('#error_average').text(response.responseJSON.errors.average);
                        $('#error_kriteria_fasilitas_id').text(response.responseJSON.errors.kriteria_fasilitas_id);
                        $('#error_map_link').text(response.responseJSON.errors.map_link);
                    }
                });
            });

            // $('#form-create').on('submit', function(event) {
            //     event.preventDefault();
            //     var formData = new FormData(this);

            //     var btn = $('#submit-button');
            //     btn.attr('disabled', true);
            //     btn.val(btn.data("loading-text"));

            //     $.ajax({
            //         url: "{{ route('restaurants.store') }}",
            //         type: "POST",
            //         data: formData,
            //         cache: false,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             if (response.success == true) {
            //                 window.location.href = "{{ route('restaurants.index') }}";
            //                 sessionStorage.setItem('success', response.message);
            //             } else if (response.success == false) {
            //                 btn.attr('disabled', false);
            //                 btn.text('Submit');
            //                 toastr.error('error', response.message);
            //             }
            //         },
            //         error: function(response) {
            //             btn.attr('disabled', false);
            //             btn.text('Submit');
            //             $('#error_name').text(response.responseJSON.errors.name);
            //             $('#error_distance').text(response.responseJSON.errors.distance);
            //             $('#error_images').text(response.responseJSON.errors.images);
            //             $('#error_address').text(response.responseJSON.errors.address);
            //             $('#error_facility').text(response.responseJSON.errors.facility);
            //             $('#error_average').text(response.responseJSON.errors.average);
            //             $('#error_qty_variasi_makanan').text(response.responseJSON.errors.qty_variasi_makanan);
            //             $('#error_map_link').text(response.responseJSON.errors.map_link);
            //         }
            //     });
            // });

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
