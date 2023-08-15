$(document).ready(function () {
    $('#permissionInput').select2({
        theme: "bootstrap-5",
        width: $('#permissionInput').data('width') ? $('#permissionInput').data('width') : $('#permissionInput').hasClass('w-100') ? '100%' : 'style',
        placeholder: $('#permissionInput').data('placeholder'),
        // dropdownParent: $('#permissionInput').parent(),
        tags: true,
        closeOnSelect: false,
    });
});
