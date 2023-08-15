<!-- Modal -->
<div class="modal fade" id="addProgramRpjmdModal" tabindex="-1" aria-labelledby="addProgramRpjmdModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addProgramRpjmdModalLabel">Modal title</h1>
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
                    <input type="hidden" name="indikator" id="indikatorId">
                    <div class="mb-3 test">
                        <label for="kodeProgramInput" class="form-label">Program</label>
                        <select name="program[]" class="form-select select2-multiple" id="kodeProgramInput" data-placeholder="Pilih..." multiple>
                        </select>
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
