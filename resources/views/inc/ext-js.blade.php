<!-- jQuery -->
<script src="{{ asset('/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('/AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- Form Custom --}}
<script src="{{ asset('/adminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.33/dist/sweetalert2.all.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/AdminLTE/dist/js/adminlte.min.js') }}"></script>

@if (Session::has('error'))
     <script>
          Swal.fire({
               icon: 'error',
               text: '{{ Session::get('error') }}',
               confirmButtonText: 'Konfirmasi',
               confirmButtonColor: '#007BFF',
               showCloseButton: true,
          })
     </script>
@elseif(Session::has('success'))
     <script>
          Swal.fire({
               icon: 'success',
               text: '{{ Session::get('success') }}',
               confirmButtonText: 'Konfirmasi',
               confirmButtonColor: '#007BFF',
               showCloseButton: true,
          })
     </script>
@endif

<script>
     $(function() {
          bsCustomFileInput.init();
     });
</script>
