<!-- Modal -->
<div class="modal fade" id="addSasaranModal" tabindex="-1" aria-labelledby="addSasaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addSasaranModalLabel">Modal title</h1>
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
                    <div class="row">
                        <div class="mb-3 col-sm-3">
                            <label for="sasaranNomorInput" class="form-label">Nomor</label>
                            <input type="number" name="nomor" class="form-control" id="sasaranNomorInput" placeholder="Nomor">
                        </div>
                        <div class="mb-3 col-sm-9">
                            <label for="sasaranInput" class="form-label">Sasaran</label>
                            <textarea name="sasaran" class="form-control" id="sasaranInput" rows="3" placeholder="Sasaran Pembangunan"></textarea>
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
