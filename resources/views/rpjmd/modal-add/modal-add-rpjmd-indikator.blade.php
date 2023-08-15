<!-- Modal -->
<div class="modal fade" id="addIndikatorModal" tabindex="-1" aria-labelledby="addIndikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addIndikatorModalLabel">Tambah Indikator</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="create">
                    <input type="hidden" name="periode" value="{{ $periode->id }}">
                    <input type="hidden" name="visi" id="visiId">
                    <input type="hidden" name="misi" id="misiId">
                    <input type="hidden" name="tujuan" id="tujuanId">
                    <input type="hidden" name="sasaran" id="sasaranId">
                    <div class="row">
                        <div class="mb-3 col-sm-12">
                            <label for="indikatorInput" class="form-label">Indikator</label>
                            <textarea name="indikator" class="form-control" id="indikatorInput" rows="3" placeholder="Indikator Pembangunan RPJMD"></textarea>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="indikatorSatuanInput" class="form-label">Satuan</label>
                            <input type="text" name="satuan" class="form-control" id="indikatorSatuanInput" placeholder="Satuan Target">
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
