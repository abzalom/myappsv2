<!-- Modal -->
<div class="modal fade" id="editIndikatorModal" tabindex="-1" aria-labelledby="editIndikatorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editIndikatorModalLabel">Edit Indikator : <span id="namaIndikatorEditModalLabel"></span></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('rpjmd.indikator.update') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="aksi" value="update">
                    <input type="hidden" name="indikatorid" id="indikatorIdEdit">
                    <div class="row">
                        <div class="mb-3 col-sm-12">
                            <label for="indikatorEdit" class="form-label">Indikator</label>
                            <textarea name="indikator" class="form-control" id="indikatorEdit" rows="3" placeholder="Indikator Pembangunan RPJMD"></textarea>
                        </div>
                        <div class="mb-3 col-sm-6">
                            <label for="indikatorSatuanEdit" class="form-label">Satuan</label>
                            <input type="text" name="satuan" class="form-control" id="indikatorSatuanEdit" placeholder="Satuan Target">
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
