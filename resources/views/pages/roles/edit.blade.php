@extends('layouts.main-content')

@section('content')
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Role</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Master</a></li>
                <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Role</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Role</a></li>
            </ol>
        </div>
        <div class="card mb-3" style="margin-top: -20px !important">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="font-weight-bold text-primary">
                    Edit Role
                </h6>
            </div>
            <div class="card-body">
                <form id="roles-form">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-2 col-form-label">Name</label>
                        <div class="col-10">
                            <input type="text" name="name" id="name" value="{{ $role->name }}"
                                class="form-control">
                            <small class="text-danger" id="name-error"></small>
                        </div>
                    </div>
                    <small class="text-danger" id="permission-error"></small>
                    <div class="row mb-3">
                        <legend class="col-form-label col-2 pt-0">Permissions</legend>
                        <div class="col-10">
                            <div class="row">
                                <div class="col">
                                    <table class="table-hover">
                                        <tr>
                                            <td class="align-top">
                                                <div class="form-check">
                                                    <input type="checkbox" id="check-all" class="form-check-input">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="form-group">
                                                    <label class="form-check-label">
                                                        <b>Aktifkan Semua Hak Akses</b>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <h6>Admin:</h6>
                                <hr>
                                @foreach ($a_permissions as $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <table class="table-hover">
                                            <tr>
                                                <td class="align-top">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $item->id }}" id="permission_{{ $item->id }}"
                                                            @if (in_array($item->id, $rolePermissions)) checked="1" @endif
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
                            <hr>
                            <div class="row">
                                <h6>User:</h6>
                                @foreach ($u_permissions as $item)
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                        <table class="table-hover">
                                            <tr>
                                                <td class="align-top">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="permission[]"
                                                            value="{{ $item->id }}" id="permission_{{ $item->id }}"
                                                            @if (in_array($item->id, $rolePermissions)) checked="1" @endif
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
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
        $('#check-all').click(function(event) {
            if (this.checked) {
                $(':checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function() {
                    this.checked = false;
                });
            }
        });

        $('#roles-form').on('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            var btn = $('#submit-button');
            btn.attr('disabled', true);
            btn.val(btn.data("loading-text"));

            $('#name-error').text('');
            $('#permission-error').text('');

            url = "{{ route('roles.update', $role->id) }}"

            $.ajax({
                url: url,
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success == true) {
                        window.location.href = "{{ route('roles.index') }}";
                        sessionStorage.setItem('success', response.message);
                    } else if (response.success == false) {
                        btn.attr('disabled', false);
                        btn.text('Submit');
                        toastr.error('error', response.message);
                    }
                },
                error: function(response) {
                    btn.attr('disabled', false);
                    btn.text('Simpan');
                    $('#name-error').text(response.responseJSON.errors.name);
                    $('#permission-error').text(response.responseJSON.errors.permission);
                }
            });
        });
    </script>
@endsection
