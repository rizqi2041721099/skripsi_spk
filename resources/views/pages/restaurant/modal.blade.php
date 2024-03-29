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
<!-- End Modals -->

<!--Modals Edit -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Restaurant</h5>
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
                          <label class="form-label" for="address">Restaurant Name</label>
                          <input type="text" class="form-control" id="edit_name" name="name">
                          <small class="text-danger" id="error_edit_name"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" id="edit_address" name="address">
                            <small class="text-danger" id="error_address"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Distance  <span class="text-danger">Input Jarak format angka (m)*</span></label>
                            <input type="text" class="form-control" id="edit_distance" name="distance">
                            <small class="text-danger" id="error_edit_distance"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Facility</label>
                            <input type="text" class="form-control" id="edit_facility" name="facility">
                            <small class="text-danger" id="error_edit_facility"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Qty Food Variety</label>
                            <input type="text" class="form-control" id="edit_qty_variasi_makanan" name="qty_variasi_makanan">
                            <small class="text-danger" id="error_qty_variasi_makanan"></small>
                        </div>
                        <div class="col-md-12 col-xs-12 mb-2">
                            <label class="form-label">Rata-Rata Harga Makanan</label>
                            <input type="text" class="form-control" data-type="currency" id="edit_average"
                            name="average" value="0">
                            <small class="text-danger" id="error_average"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="images" id="foto_edit">
                            <img id="imagePreviewEdit" class="img-preview-edit mt-3" width="150" height="150" />
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
