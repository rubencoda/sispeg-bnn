{{-- Modal Change Password --}}
<div class="modal fade" id="change-password">
     <div class="modal-dialog modal-lg">
          <div class="modal-content">
               <div class="modal-header">
                    <h4 class="modal-title">Change Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>
               </div>
               <form action="{{ route('change-password') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-body">
                         <div class="form-group">
                              <label for="old_password">Password Lama</label>
                              <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Password Lama">
                              @error('old_password')
                                   <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                   </div>
                              @enderror
                         </div>
                         <div class="form-group">
                              <label for="new_password">Password Baru</label>
                              <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="Password Baru">
                              @error('new_password')
                                   <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                   </div>
                              @enderror
                         </div>

                         <div class="form-group">
                              <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                              <input type="password" class="form-control" name="new_password_confirmation" placeholder="Konfirmasi Password Baru">
                         </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                         <button type="submit" class="btn btn-primary">Save changes</button>
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
               </form>
          </div>
          <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@push('js')
     <script type="text/javascript">
          @if ($errors->has('new_password') || $errors->has('old_password'))
               $('#change-password').modal('show');
          @endif
     </script>
@endpush
