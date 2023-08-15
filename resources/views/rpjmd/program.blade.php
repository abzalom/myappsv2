<tr>
    <td>
        <div class="row mb-2 mt-2">
            <div style="width: 5%; padding-right: 0;">
                VISI
            </div>
            <div style="width: 95%">
                {{ $visi->visi }}
            </div>
        </div>
    </td>
    <td>
        <div class="row mb-2 mt-2">
            <div style="width: 7%; padding-right: 0;">
                MISI {{ $misi->nomor }}
            </div>
            <div style="width: 90%">
                {{ $misi->misi }}
            </div>
        </div>
    </td>
    <td>
        <div class="row mb-2 mt-2">
            <div style="width: 10%; padding-right: 0;">
                TUJUAN {{ $tujuan->nomor }}
            </div>
            <div style="width: 90%">
                {{ $tujuan->tujuan }}
            </div>
        </div>
    </td>
    <td>
        <div class="row mb-2 mt-2">
            <div style="width: 12%; padding-right: 0; text-align:right">
                SASARAN {{ $sasaran->nomor }}
            </div>
            <div style="width: 83%">
                {{ $sasaran->sasaran }}
            </div>
        </div>
    </td>
    <td>
        <div class="row mb-2 mt-2">
            <div style="width: 15%; padding-right: 0; padding-left:3%; text-align:right">
                INDIKATOR :
            </div>
            <div style="width: 80%">
                {{ $indikator->indikator }} <small class="text-muted italic">({{ $indikator->satuan }})</small>
            </div>
            <div style="width: 5%; padding-left: 0;">
                <button class="btn btn-sm btn-primary btn-add-program" value="{{ $indikator->id }}" data-bs-toggle="modal" data-bs-target="#addProgramRpjmd"><i class="fa-solid fa-plus-square"></i></button>
            </div>
        </div>
    </td>
    <td style="width: 10%"></td>
    <td></td>
    <td style="width: 10%"></td>
</tr>
