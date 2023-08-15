<!-- Modal -->
<div class="modal fade" id="addTujuanModal" tabindex="-1" aria-labelledby="addTujuanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addTujuanModalLabel">Tujuan Misi Ke </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="create">
                    <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                    <input type="hidden" name="visi" id="visiId">
                    <input type="hidden" name="misi" id="misiId">
                    <div class="row">
                        <div class="col-sm-3 mb-3">
                            <label for="rpjmdNomorTujuanInput" class="form-label">Nomor</label>
                            <input type="number" name="nomor" class="form-control" id="rpjmdNomorTujuanInput" placeholder="Nomor">
                        </div>
                        <div class="col-sm-9 mb-3">
                            <label for="rpjmdTujuanInput" class="form-label">Tujuan Pembangunan</label>
                            <textarea name="tujuan" class="form-control" id="rpjmdTujuanInput" placeholder="Tujuan Pembagunan RPJMD" rows="4"></textarea>
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
