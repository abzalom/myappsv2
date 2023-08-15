$(document).ready(function () {

    $('.datatables-pagu').DataTable({
        rowGroup: {
            dataSrc: [0],
        },
        columnDefs: [{
                targets: [0],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('.btn-add-pagu-opd').on('click', function () {
        kodeopd = $(this).val();
        $('#uraianPaguInput').html('<option value="">Pilih...</option>');
        $('#jumlahPaguInput').val('');
        $.ajax({
            type: "post",
            url: "/api/opd/kode",
            data: {
                kode_opd: kodeopd
            },
            dataType: "JSON",
            success: function (opd) {
                $('#addPaguOpdModalLabel').html(opd.nama_opd)
                $('#opdPaguInput').val(opd.kode_opd)
                $.ajax({
                    type: "post",
                    url: "/api/rekening/pendapatan/uraian/search",
                    data: {
                        kode_opd: opd.kode_opd
                    },
                    dataType: "JSON",
                    success: function (uraian) {
                        $.map(uraian, function (val, key) {
                            $('#uraianPaguInput').append('<option value="' + val.kode_uraian + '">' + val.uraian + '</option>');
                        });
                    }
                });
                $('#uraianPaguInput').select2({
                    theme: "bootstrap-5",
                    width: $('#uraianPaguInput').data('width') ? $('#uraianPaguInput').data('width') : $('#uraianPaguInput').hasClass('w-100') ? '100%' : 'style',
                    placeholder: $('#uraianPaguInput').data('placeholder'),
                    dropdownParent: $('#uraianPaguInput').parent(),
                });
            }
        });
    });

    $('.btn-edit-pagu-opd').on('click', function () {
        iduraian = $(this).val();
        $('#uraianPaguInputEdit').html('');
        $('#jumlahPaguInputEdit').val('');
        $('#idPaguEdit').val('');
        $.ajax({
            type: "post",
            url: "/api/pagu/byid",
            data: {
                id: iduraian
            },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                $('#idPaguEdit').val(response.id);
                $('#uraianPaguInputEdit').html('<option value="' + response.uraianpendapatan.kode_uraian + '" selected>' + response.uraianpendapatan.uraian + '</option>');
                $('#jumlahPaguInputEdit').val(response.jumlah);
            }
        });
    });

});
