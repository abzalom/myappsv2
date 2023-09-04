$(document).ready(function () {

    $('#rancanganBidangInput').on('change', function () {
        $('#rancanganProgramInput').removeAttr('disabled');

        $('#rancanganHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#rancanganIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#rancanganKegiatanInput').attr('disabled', true);
        $('#rancanganSubkegiatanInput').attr('disabled', true);
        $('#rancanganKegiatanInput').html('<option value="">Pilih...</option>');
        $('#rancanganSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#rancanganProgramInput').html('<option value="">Pilih...</option>')
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
                    $('#rancanganProgramInput').append('<option value="' + val.kode_program + '">' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodebidang !== '') {
            $('#rancanganProgramInput').removeAttr('disabled');
        } else {
            $('#rancanganProgramInput').html('<option value="">Pilih...</option>')
            $('#rancanganProgramInput').attr('disabled', true);
        }
    });

    $('#rancanganProgramInput').on('change', function () {

        $('#rancanganHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#rancanganIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#rancanganKegiatanInput').attr('disabled', true);
        $('#rancanganSubkegiatanInput').attr('disabled', true);
        $('#rancanganKegiatanInput').html('<option value="">Pilih...</option>');
        $('#rancanganSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#rancanganKegiatanInput').html('<option value="">Pilih...</option>')
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
                    $('#rancanganKegiatanInput').append('<option value="' + val.kode_kegiatan + '">' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodeprogram !== '') {
            $('#rancanganKegiatanInput').removeAttr('disabled');
        } else {
            $('#rancanganKegiatanInput').html('<option value="">Pilih...</option>')
            $('#rancanganKegiatanInput').attr('disabled', true);
        }
    });

    $('#rancanganKegiatanInput').on('change', function () {

        $('#rancanganHasilKegiatanReadonly').val('Hasil Kegiatan');
        $('#rancanganIndikatorSubkegiatanReadonly').val('Indikator');
        $('#satuanSubkegAddOn').html('Satuan');

        $('#rancanganSubkegiatanInput').attr('disabled', true);
        $('#rancanganSubkegiatanInput').html('<option value="">Pilih...</option>');

        $('#rancanganSubkegiatanInput').html('<option value="">Pilih...</option>')
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
                    $('#rancanganSubkegiatanInput').append('<option value="' + val.id + '">' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        if (kodekegiatan !== '') {
            $('#rancanganSubkegiatanInput').removeAttr('disabled');
        } else {
            $('#rancanganSubkegiatanInput').html('<option value="">Pilih...</option>')
            $('#rancanganSubkegiatanInput').attr('disabled', true);
        }
    });

    $('#rancanganSubkegiatanInput').on('change', function () {
        id = $(this).val();
        $.ajax({
            type: "post",
            url: "/api/nomen/subkegiatan/by/id",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (subkegiatan) {
                $('#rancanganHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#rancanganIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
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
        rutin = $('#rancanganBidangInput').find(':selected').data('rutin');
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
                    $('#rancanganProgramInput').append('<option value="' + val.kode_program + '" ' + selected + '>' + val.kode_program + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#rancanganProgramInput').removeAttr('disabled');
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
                    $('#rancanganKegiatanInput').append('<option value="' + val.kode_kegiatan + '"' + selected + '>' + val.kode_kegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#rancanganKegiatanInput').removeAttr('disabled');
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
                    $('#rancanganSubkegiatanInput').append('<option value="' + val.id + '"' + selected + '>' + val.kode_subkegiatan + ' ' + val.uraian + '</option>');
                });
            }
        });
        $('#rancanganSubkegiatanInput').removeAttr('disabled');
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
                $('#rancanganHasilKegiatanReadonly').val(subkegiatan.kinerja);
                $('#rancanganIndikatorSubkegiatanReadonly').val(subkegiatan.indikator);
                $('#satuanSubkegAddOn').html(subkegiatan.satuan);
            }
        });
        $('#rancanganCapaianProgramInput').val(oldcapaian);
        $('#rancanganTargetProgramInput').val(oldtarget_capaian);
        $('#rancanganSatuanProgramInput').val(oldsatuan_capaian);
        $('#rancanganTargetKegiatanInput').val(oldtarget_hasil);
        $('#rancanganSatuanKegiatanInput').val(oldsatuan_hasil);
        $('#rancanganTargetSubkegInput').val(oldtarget_indikator);
        $('#rancanganMulaiInput').val(oldmulai);
        $('#rancanganSelesaiInput').val(oldselesai);
    }

});
