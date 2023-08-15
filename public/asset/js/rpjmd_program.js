$(document).ready(function () {
    $('.datatables-program').DataTable({
        rowGroup: {
            dataSrc: [0, 1, 2, 3, 4],
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
                targets: [3],
                visible: false,
            },
            {
                targets: [4],
                visible: false,
            },
            {
                targets: '_all',
                searchable: true
            },
        ],
    });

    $('body').delegate('.btn-add-program', 'click', function () {
        indikatorid = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/rpjmd/indikator",
            data: {
                id: indikatorid
            },
            dataType: "JSON",
            success: function (indikator) {
                console.log(indikator.programs);
                $.map(indikator.programs, function (progVal, progKey) {
                    $('#kodeProgramInput').append('<option value="' + progVal.kode_program + '">' + progVal.kode_program + ' - ' + progVal.uraian + '</option>');
                });
                $('#visiId').val(indikator.indikator.sasaran.tujuan.misi.visi.id)
                $('#misiId').val(indikator.indikator.sasaran.tujuan.misi.id)
                $('#tujuanId').val(indikator.indikator.sasaran.tujuan.id)
                $('#sasaranId').val(indikator.indikator.sasaran.id)
                $('#indikatorId').val(indikator.indikator.id)
            }
        });
    });

    $('#addProgramRpjmdModal').on('hidden.bs.modal', function () {
        $(".select2-multiple").html('');
        $(".select2-multiple").val(1).trigger("change.select2");
    })
});
