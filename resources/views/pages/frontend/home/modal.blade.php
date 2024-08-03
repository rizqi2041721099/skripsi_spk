<div class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-body">
            <p>Data tidak ditemukan</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn-close">Close</button>
        </div>
        </div>
    </div>
    </div>

    <!--Modals Edit -->
<div class="modal fade" id="edit-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-edit">Edit Bobot Kriteria</h5>
            </div>
            <div class="modal-body">
                <form id="form-edit" name="form-tambah-edit">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <input type="hidden" id="id" name="id" />
                        <div class="col-md-4 mb-2 col-xs-3">
                            <label class="form-label" for="address">Bobot Harga Makanan</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="bobot_harga_makanan"
                                    id="edit_bobot_harga_makanan">
                                <small class="text-danger" id="error_edit_bobot_harga_makanan"></small>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 col-xs-3">
                            <label class="form-label" for="address">Bobot Jarak</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="bobot_jarak"
                                    id="edit_bobot_jarak">
                            <small class="text-danger"
                                    id="error_edit_bobot_jarak"></small>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 col-xs-3">
                            <label class="form-label" for="address">Bobot Fasilitas</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="bobot_fasilitas"
                                    id="edit_bobot_fasilitas">
                            <small class="text-danger"
                                    id="error_edit_bobot_fasilitas"></small>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 col-xs-3">
                            <label class="form-label" for="address">Bobot Jam Operasional</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="bobot_jam_operasional"
                                    id="edit_bobot_jam_operasional">
                            <small class="text-danger"
                                    id="error_edit_bobot_jam_operasional"></small>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 col-xs-3">
                            <label class="form-label" for="address">Bobot Variasi Menu</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="bobot_variasi_menu"
                                    id="edit_bobot_variasi_menu">
                                <small class="text-danger" id="error_edit_bobot_variasi_menu"></small>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal" id="back">Kembali</button>
                <button type="submit" id="tombol-simpan" value="create" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modals -->
