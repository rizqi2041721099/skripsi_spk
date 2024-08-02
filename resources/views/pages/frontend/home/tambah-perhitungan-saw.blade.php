@extends('layouts.frontend.app-detail')
@section('title-head')
    Tambah
@endsection
@section('list')
    <li class="breadcrumb-item text-white active" aria-current="page">Perhitungan Saw</li>
@endsection
@section('content')
<div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-12 bg-dark d-flex align-items-center">
            <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="d-flex justify-content-between">
                    <h5 class="section-title ff-secondary text-start text-primary fw-normal">Perhitungan Saw</h5>
                    <a href="{{ route('list.perhitungan.saw') }}" class="btn btn-outline-warning text-capitalize" target="_blank">Check Data Perhitungan Saw Anda</a>
                </div>
                <h1 class="text-white mb-4">Anda dapat menambahkan perhitungan sendiri!</h1>
                <form id="form_alternatif">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="name_restaurant" value="{{ old('name_restaurant') }}" required>
                                <label for="range-variasi-makanan">Nama Restaurant</label>
                            </div>
                            <span class="text-danger" id="error_name_restaurant"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="v_variasi_makanan" id="" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($getVariasiMenu as $item)
                                        <option value="{{ $item->id }}">({{ $item->skala }}) {{ $item->standard_value }} ({{ $item->range_value }})</option>
                                    @endforeach
                                </select>
                                <label for="range-variasi-makanan">Kriteria Variasi Menu</label>
                            </div>
                            <span class="text-danger" id="error_v_variasi_makanan"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="v_jarak" id="jarak" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($getJarak as $item)
                                        <option value="{{ $item->id }}">({{ $item->skala }}) {{ $item->standard_value }} ({{ $item->range_value }})</option>
                                    @endforeach
                                </select>
                                <label for="rentang-jarak">Kriteria Jarak</label>
                            </div>
                            <span class="text-danger" id="error_v_jarak"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="v_harga_makanan" id="harga" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($getHarga as $item)
                                        <option value="{{ $item->id }}">({{ $item->skala }}) {{ $item->standard_value }} ({{ $item->range_value }})</option>
                                    @endforeach
                                </select>
                                <label for="range-harga">Kriteria Harga Makanan</label>
                            </div>
                            <span class="text-danger" id="error_v_harga_makanan"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="v_jam_operasional" id="jam_operasional" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($getJamOperasional as $item)
                                        <option value="{{ $item->id }}">{{ $item->standard_value }} ({{ $item->range_value }})</option>
                                    @endforeach
                                </select>
                                <label for="select1">Kriteria Jam Operasional</label>
                            </div>
                            <span class="text-danger" id="error_v_jam_operasional"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select name="v_fasilitas" id="fasilitas" class="form-control" required>
                                    <option value="">Pilih</option>
                                    @foreach ($getFasilitas as $item)
                                        <option value="{{ $item->id }}"> ({{ $item->skala }}) {{ $item->standard_value }}</option>
                                    @endforeach
                                </select>
                                <label for="select1">Kriteria Fasilitas</label>
                            </div>
                            <span class="text-danger" id="error_v_fasilitas"></span>
                        </div>
                        <hr>
                        <h6 class="fw-bold text-white">Bobot Kriteria (format angka)</h6>
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="bobot_harga_makanan" value="{{ old('bobot_harga_makanan') }}" required>
                                <label for="range-variasi-makanan">Bobot Harga Makanan</label>
                            </div>
                            <span class="text-danger" id="error_bobot_harga_makanan"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="bobot_jarak" value="{{ old('bobot_jarak') }}" required>
                                <label for="range-variasi-makanan">Bobot Jarak</label>
                            </div>
                            <span class="text-danger" id="error_bobot_jarak"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="bobot_fasilitas" value="{{ old('bobot_fasilitas') }}" required>
                                <label for="range-variasi-makanan">Bobot Fasilitas</label>
                            </div>
                            <span class="text-danger" id="error_bobot_fasilitas"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="bobot_jam_operasional" value="{{ old('bobot_jam_opearsional') }}" required>
                                <label for="range-variasi-makanan">Bobot Jam Operasional</label>
                            </div>
                            <span class="text-danger" id="error_bobot_jam_operasional"></span>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                               <input type="text" class="form-control" name="bobot_variasi_menu" value="{{ old('bobot_variasi_menu') }}" required>
                                <label for="range-variasi-makanan">Bobot Variasi Menu</label>
                            </div>
                            <span class="text-danger" id="error_bobot_variasi_menu"></span>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary w-100 py-3" type="submit" id="submit-button">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        if (sessionStorage.getItem('success')) {
            let data = sessionStorage.getItem('success');
            toastr.success('', data, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });

            sessionStorage.clear();
        }

        const error = '{{ session('error') }}';
        if (error) {
            toastr.error('', error, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });

            sessionStorage.clear();
        }

        const success = '{{ session('success') }}';
        if (success) {
            toastr.success('', success, {
                timeOut: 1500,
                preventDuplicates: true,
                progressBar: true,
                positionClass: 'toast-top-right',
            });

            sessionStorage.clear();
        }
    });
</script>
@section('scripts')
    <script type="application/javascript">
        $(document).ready(function () {
            $('#form_alternatif').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('store.perhitungan.saw') }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            window.location.href = 'tambah-perhitungan-saw';
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
                        $('#error_name_restaurant').text(response.responseJSON.errors.name_restaurant);
                        $('#error_v_harga_makanan').text(response.responseJSON.errors.v_harga_makanan);
                        $('#error_v_jam_operasional').text(response.responseJSON.errors.v_jam_operasional);
                        $('#error_v_variasi_makanan').text(response.responseJSON.errors.v_variasi_makanan);
                        $('#error_v_jarak').text(response.responseJSON.errors.v_jarak);
                        $('#error_v_fasilitas').text(response.responseJSON.errors.v_fasilitas);
                        $('#error_bobot_harga_makanan').text(response.responseJSON.errors.bobot_harga_makanan);
                        $('#error_bobot_harga_jarak').text(response.responseJSON.errors.bobot_harga_jarak);
                        $('#error_bobot_harga_fasilitas').text(response.responseJSON.errors.bobot_harga_fasilitas);
                        $('#error_bobot_jam_operasional').text(response.responseJSON.errors.bobot_jam_operasional);
                        $('#error_bobot_variasi_menu').text(response.responseJSON.errors.bobot_variasi_menu);
                    }
                });
            });
        });

    </script>
@endsection
@endsection
