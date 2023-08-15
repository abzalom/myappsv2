$(document).ready(function () {
    $('.datatables-sasaran').DataTable({
        rowGroup: {
            dataSrc: [0, 1, 2],
        },
        columnDefs: [{
                targets: [0],
                visible: false,
            },
            {
                targets: [1],
                visible: false,
            },
            {
                targets: [2],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('.btn-add-sasaran').on('click', function () {
        visi = $(this).data('visi');
        misi = $(this).data('misi');
        tujuan = $(this).data('tujuan');
        tujuannomor = $(this).data('tujuannomor');
        misinomor = $(this).data('misinomor');
        $('#visiId').val(visi);
        $('#misiId').val(misi);
        $('#tujuanId').val(tujuan);
        $('#addSasaranModalLabel').html('Misi Nomor ' + misinomor + '<br> Tujuan Nomor ' + tujuannomor);
    });

    $('.btn-edit-sasaran').on('click', function () {
        $('#editSasaranModalLabel').html('Modal title');
        $('#sasaranIdEdit').val('');
        $('#sasaranNomorEdit').val('');
        $('#sasaranEdit').val('');
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rpjmd/sasaran",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (sasaran) {
                $('#editSasaranModalLabel').html('Misi Nomor ' + sasaran.tujuan.misi.nomor + '<br> Tujuan Nomor ' + sasaran.tujuan.nomor);
                $('#sasaranIdEdit').val(sasaran.id);
                $('#sasaranNomorEdit').val(sasaran.nomor);
                $('#sasaranEdit').val(sasaran.sasaran);
            }
        });
    });
});
