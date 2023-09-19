<!-- Modal -->
<div class="modal fade" id="arsipSumberDanaPerubahanModal" tabindex="-1" aria-labelledby="arsipSumberDanaPerubahanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="arsipSumberDanaPerubahanModalLabel">Arsip</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-sm table-bordered">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>Kode</th>
                            <th>Uraian</th>
                            <th>Jumlah</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletes as $delete)
                            <tr>
                                <td style="width: 25%">{{ $delete->kode_sumberdana }}</td>
                                <td style="width: 30%">{{ $delete->uraian }}</td>
                                <td style="width: 30%" class="text-end">{{ number_format($delete->jumlah, 2, ',', '.') }}</td>
                                <td style="width: 15%" class="text-center">
                                    <form action="/perubahan/sumberdana/restore" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $delete->id }}">
                                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-rotate" title="restore"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
