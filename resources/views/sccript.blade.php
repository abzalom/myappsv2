<script src="/vendors/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<script src="/asset/js/select2.js"></script>
{{-- <script src="/vendors/select2/dist/js/select2.full.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
{{-- <script src="/vendors/datatables/pdfmake.min.js.map"></script> --}}
<script src="/vendors/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
{{-- <script src="/vendors/datatables/pdfmake-0.1.36/vfs_fonts.js"></script> --}}
<script src="/vendors/datatables/dataTables.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="{{ asset('vendors/datatables/RowGroup-1.2.0/js/dataTables.rowGroup.js') }}"></script>
<script src="{{ asset('vendors/datatables/RowGroup-1.2.0/js/rowGroup.bootstrap5.min.js') }}"></script>
<script src="{{ asset('vendors/fontawesome/js/all.js') }}"></script>
<script>
    $('.select2-single').each(function() {
        $(this).select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder')
        })
    });
    $('.select2-multiple').each(function() {
        $(this).select2({
            theme: "bootstrap-5",
            multiple: true,
            allowClear: true,
            closeOnSelect: false,
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        })
    });
    $('.datatables').DataTable({});
</script>
