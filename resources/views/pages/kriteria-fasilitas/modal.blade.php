<!--Modals Add -->
<div class="modal fade" id="create-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-judul"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create" name="form-tambah">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2 col-xs-12">
                            <label class="form-label" for="address">Nilai</label>
                            <input type="text" class="form-control" id="value" name="value">
                            <small class="text-danger" id="error_value"></small>
                          </div>
                          <div class="col-md-12">
                              <label for="">Standar Value</label>
                              <input type="text" class="form-control" name="standard_value" id="standard_value">
                              <small class="text-danger" id="error_standard_value"></small>
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
<!-- End Modals -->

<!--Modals Edit -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Kriteria Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" name="form-tambah-edit">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-12 mb-2 col-xs-12">
                          <input type="hidden" id="id" name="id" />
                          <label class="form-label" for="address">Nilai</label>
                          <input type="text" class="form-control" id="edit_value" name="value">
                          <small class="text-danger" id="error_edit_value"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="">Standar Value</label>
                            <input type="text" class="form-control" name="standard_value" id="edit_standard_value">
                            <small class="text-danger" id="error_edit_standard_value"></small>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Kembali</button>
                <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modals -->
