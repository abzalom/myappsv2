<!-- Modal -->
<div class="modal fade" id="editTujuanModal" tabindex="-1" aria-labelledby="editTujuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editTujuanModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rpjmd.tujuan.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="update">
                    <input type="hidden" name="tujuanid" id="tujuanIdEdit">
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <label for="rpjmdNomorTujuanEdit" class="form-label">Nomor</label>
                            <input type="number" name="nomor" class="form-control" id="rpjmdNomorTujuanEdit" placeholder="Nomor">
                        </div>
                        <div class="col-sm-9 mb-3">
                            <label for="rpjmdTujuanEdit" class="form-label">Tujuan Pembangunan</label>
                            <textarea name="tujuan" class="form-control" id="rpjmdTujuanEdit" placeholder="Tujuan Pembagunan RPJMD" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
