@extends('layouts.main-content')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kriteria</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('kriterias.index') }}">Kriteria</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Kriteria</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Edit Kriteria
                </h6>
            </div>
            <div class="card-body">
                <form id="kriterias_table">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                       <div class="col-md-12">
                            <label for="restaurant">Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
                            <small class="text-danger" id="error_restaurant_id"></small>
                       </div>
                       <div class="col-md-12">
                            <label class="form-label">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="">--Pilih--</option>
                                <option value="1" {{ $data->category == 1 ? 'selected' : '' }}>Cost</option>
                                <option value="2" {{ $data->category == 2 ? 'selected' : '' }}>Benefit</option>
                            </select>
                            <small class="text-danger" id="error_category"></small>
                       </div>
                       <div class="col-md-12">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="description" id="description" value="{{ $data->description }}">
                       </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <a href="{{ route('kriterias.index') }}" class="btn btn-secondary">Kembali</a>
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
            $('#kriterias_table').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                var btn = $('#submit-button');
                btn.attr('disabled', true);
                btn.val(btn.data("loading-text"));

                $.ajax({
                    url: "{{ route('kriterias.update', $data->id) }}",
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success == true) {
                            window.location.href = "{{ route('kriterias.index') }}";
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
                        $('#error_category').text(response.responseJSON.errors.category);
                        $('#error_description').text(response.responseJSON.errors.description);
                    }
                });
            });
        });

    </script>
@endsection
