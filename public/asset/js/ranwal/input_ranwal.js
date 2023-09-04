$(document).ready(function () {

    $('#ranwalBidangInput').on('change', function () {
        $('#ranwalProgramInput').removeAttr('disabled');

        $('#ranwalHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#ranwalIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#ranwalKegiatanInput').attr('disabled', true);
        $('#ranwalSubkegiatanInput').attr('disabled', true);
        $('#ranwalKegiatanInput').html('<option value="">Pilih...</option>');
        $('#ranwalSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#ranwalProgramInput').html('<option value="">Pilih...</option>')
        kodebidang = $(this).val();
        rutin = $(this).find(':selected').data('rutin');
        $.ajax({
            type: "post",
            url: "/api/nomen/program/parent/bidang",
            data: {
                kode_bidang: kodebidang,
                rutin: rutin,
            },
            dataType: "JSON",
            success: function (programs) {
                $.each(programs, function (index, val) {
                    $('#ranwalProgramInput').append('<option value="' + val.kode_program + '">' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodebidang !== '') {
            $('#ranwalProgramInput').removeAttr('disabled');
        } else {
            $('#ranwalProgramInput').html('<option value="">Pilih...</option>')
            $('#ranwalProgramInput').attr('disabled', true);
        }
    });

    $('#ranwalProgramInput').on('change', function () {

        $('#ranwalHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#ranwalIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#ranwalKegiatanInput').attr('disabled', true);
        $('#ranwalSubkegiatanInput').attr('disabled', true);
        $('#ranwalKegiatanInput').html('<option value="">Pilih...</option>');
        $('#ranwalSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#ranwalKegiatanInput').html('<option value="">Pilih...</option>')
        kodeprogram = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/kegiatan/parent/program",
            data: {
                kode_program: kodeprogram,
            },
            dataType: "JSON",
            success: function (kegiatans) {
                $.each(kegiatans, function (index, val) {
                    $('#ranwalKegiatanInput').append('<option value="' + val.kode_kegiatan + '">' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodeprogram !== '') {
            $('#ranwalKegiatanInput').removeAttr('disabled');
        } else {
            $('#ranwalKegiatanInput').html('<option value="">Pilih...</option>')
            $('#ranwalKegiatanInput').attr('disabled', true);
        }
    });

    $('#ranwalKegiatanInput').on('change', function () {

        $('#ranwalHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#ranwalIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#ranwalSubkegiatanInput').attr('disabled', true);
        $('#ranwalSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#ranwalSubkegiatanInput').html('<option value="">Pilih...</option>')
        kodekegiatan = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/parent/kegiatan",
            data: {
                kode_kegiatan: kodekegiatan,
            },
            dataType: "JSON",
            success: function (subkegiatans) {
                $.each(subkegiatans, function (index, val) {
                    $('#ranwalSubkegiatanInput').append('<option value="' + val.id + '">' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodekegiatan !== '') {
            $('#ranwalSubkegiatanInput').removeAttr('disabled');
        } else {
            $('#ranwalSubkegiatanInput').html('<option value="">Pilih...</option>')
            $('#ranwalSubkegiatanInput').attr('disabled', true);
        }
    });

    $('#ranwalSubkegiatanInput').on('change', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/by/id",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (subkegiatan) {
                $('#ranwalHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#ranwalIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
                $('#satuanSubkegAddOn').html(subkegiatan.satuan);
            }
        });
    });

    oldbidang = $('#oldbidang').val();
    oldprogram = $('#oldprogram').val();
    oldkegiatan = $('#oldkegiatan').val();
    oldsubkegiatan = $('#oldsubkegiatan').val();
    oldcapaian = $('#oldcapaian').val();
    oldtarget_capaian = $('#oldtarget_capaian').val();
    oldsatuan_capaian = $('#oldsatuan_capaian').val();
    oldtarget_hasil = $('#oldtarget_hasil').val();
    oldsatuan_hasil = $('#oldsatuan_hasil').val();
    oldtarget_indikator = $('#oldtarget_indikator').val();
    oldmulai = $('#oldmulai').val();
    oldselesai = $('#oldselesai').val();

    if (oldbidang !== '') {
        rutin = $('#ranwalBidangInput').find(':selected').data('rutin');
        $.ajax({
            type: "post",
            url: "/api/nomen/program/parent/bidang",
            data: {
                kode_bidang: oldbidang,
                rutin: rutin,
            },
            dataType: "JSON",
            success: function (programs) {
                $.each(programs, function (index, val) {
                    selected = val.kode_program == oldprogram ? 'selected' : ''
                    $('#ranwalProgramInput').append('<option value="' + val.kode_program + '" ' + selected + '>' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#ranwalProgramInput').removeAttr('disabled');
    }

    if (oldprogram !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/kegiatan/parent/program",
            data: {
                kode_program: oldprogram,
            },
            dataType: "JSON",
            success: function (kegiatans) {
                $.each(kegiatans, function (index, val) {
                    selected = val.kode_kegiatan == oldkegiatan ? 'selected' : ''
                    $('#ranwalKegiatanInput').append('<option value="' + val.kode_kegiatan + '"' + selected + '>' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#ranwalKegiatanInput').removeAttr('disabled');
    }

    if (oldkegiatan !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/parent/kegiatan",
            data: {
                kode_kegiatan: oldkegiatan,
            },
            dataType: "JSON",
            success: function (subkegiatans) {
                $.each(subkegiatans, function (index, val) {
                    selected = val.id == oldsubkegiatan ? 'selected' : ''
                    $('#ranwalSubkegiatanInput').append('<option value="' + val.id + '"' + selected + '>' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#ranwalSubkegiatanInput').removeAttr('disabled');
    }

    if (oldsubkegiatan !== '') {
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/by/id",
            data: {
                id: oldsubkegiatan
            },
            dataType: "JSON",
            success: function (subkegiatan) {
                $('#ranwalHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#ranwalIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
                $('#satuanSubkegAddOn').html(subkegiatan.satuan);
            }
        });
        $('#ranwalCapaianProgramInput').val(oldcapaian);
        $('#ranwalTargetProgramInput').val(oldtarget_capaian);
        $('#ranwalSatuanProgramInput').val(oldsatuan_capaian);
        $('#ranwalTargetKegiatanInput').val(oldtarget_hasil);
        $('#ranwalSatuanKegiatanInput').val(oldsatuan_hasil);
        $('#ranwalTargetSubkegInput').val(oldtarget_indikator);
        $('#ranwalMulaiInput').val(oldmulai);
        $('#ranwalSelesaiInput').val(oldselesai);
    }

});
