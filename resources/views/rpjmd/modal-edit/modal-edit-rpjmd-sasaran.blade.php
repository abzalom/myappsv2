<!-- Modal -->
<div class="modal fade" id="editSasaranModal" tabindex="-1" aria-labelledby="editSasaranModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editSasaranModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rpjmd.sasaran.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="update">
                    <input type="hidden" name="sasaranid" id="sasaranIdEdit">
                    <div class="row">
                        <div class="mb-3 col-sm-3">
                            <label for="sasaranNomorEdit" class="form-label">Nomor</label>
                            <input type="number" name="nomor" class="form-control" id="sasaranNomorEdit" placeholder="Nomor">
                        </div>
                        <div class="mb-3 col-sm-9">
                            <label for="sasaranEdit" class="form-label">Sasaran</label>
                            <textarea name="sasaran" class="form-control" id="sasaranEdit" rows="3" placeholder="Sasaran Pembangunan"></textarea>
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
