@extends('layouts.main')

@section('title')
     Jenis Cuti
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Jenis Cuti</h1>
               </div>
               <div class="col-sm-6">
                    <div class="float-sm-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#TambahJenisCuti">Tambah Jenis Cuti</button>
                    </div>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <!-- Default box -->
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Jenis Cuti</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama Jenis Cuti</th>
                              <th>Type Jenis Cuti</th>
                              <th>Total Hari</th>
                              <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>
                                        {{ $item->nama_cuti }}
                                   </td>
                                   <td>
                                        {{ $item->type_cuti }}
                                   </td>
                                   <td>
                                        {{ $item->total_hari }}
                                   </td>
                                   <td class="text-center">
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ShowJenisCuti{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger delete-jenis-cuti" data-id="{{ $item->id }}" data-namajeniscuti="{{ $item->nama_cuti }}"><i class="fas fa-trash"></i></a>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
     <!-- /.card -->

     {{-- Modal Tambah Jenis Cuti --}}
     <div class="modal fade" id="TambahJenisCuti">
          <div class="modal-dialog modal-md">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Tambah Jenis Cuti</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <form action="{{ route('insert-jenis-cuti') }}" method="POST">
                         @csrf
                         <div class="modal-body">
                              <div class="form-group">
                                   <label>Nama Cuti</label>
                                   <input type="text" class="form-control @error('nama_cuti') is-invalid @enderror" name="nama_cuti">
                                   @error('nama_cuti')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Type Cuti</label>
                                   <select class="form-control @error('type_cuti') is-invalid @enderror" name="type_cuti">
                                        <option value="" disabled selected>- Pilih Type Cuti -</option>
                                        <option value="Non Jatah Cuti">Non Jatah Cuti</option>
                                        <option value="Jatah Cuti">Jatah Cuti</option>
                                   </select>
                                   @error('type_cuti')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Total Hari</label>
                                   <input type="number" class="form-control @error('total_hari') is-invalid @enderror" name="total_hari" min="1">
                                   @error('total_hari')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                         </div>
                         <div class="modal-footer justify-content-between">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                         </div>
                    </form>
               </div>
               <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
     </div>

     {{-- Modal Edit Jenis Cuti --}}
     @foreach ($data as $item)
          <div class="modal fade" id="ShowJenisCuti{{ $item->id }}">
               <div class="modal-dialog modal-md">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title">Edit Jenis Cuti</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                         <form action="{{ route('update-jenis-cuti') }}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="id_jenis_cuti" value="{{ $item->id }}">
                              <div class="modal-body">
                                   <div class="form-group">
                                        <label>Nama Cuti</label>
                                        <input type="text" class="form-control @error('nama_cuti') is-invalid @enderror" name="nama_cuti" value="{{ $item->nama_cuti }}">
                                        @error('nama_cuti')
                                             <div class="invalid-feedback">
                                                  {{ $message }}
                                             </div>
                                        @enderror
                                   </div>
                                   <div class="form-group">
                                        <label>Type Cuti</label>
                                        <select class="form-control @error('type_cuti') is-invalid @enderror" name="type_cuti">
                                             <option value="" disabled selected>- Pilih Type Cuti -</option>
                                             <option value="Non Jatah Cuti" {{ $item->type_cuti == 'Non Jatah Cuti' ? 'selected' : '' }}>Non Jatah Cuti</option>
                                             <option value="Jatah Cuti" {{ $item->type_cuti == 'Jatah Cuti' ? 'selected' : '' }}>Jatah Cuti</option>
                                        </select>
                                        @error('type_cuti')
                                             <div class="invalid-feedback">
                                                  {{ $message }}
                                             </div>
                                        @enderror
                                   </div>
                                   <div class="form-group">
                                        <label>Total Hari</label>
                                        <input type="number" class="form-control @error('total_hari') is-invalid @enderror" name="total_hari" value="{{ $item->total_hari }}" min="1">
                                        @error('total_hari')
                                             <div class="invalid-feedback">
                                                  {{ $message }}
                                             </div>
                                        @enderror
                                   </div>
                              </div>
                              <div class="modal-footer justify-content-between">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                   <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                              </div>
                         </form>
                    </div>
                    <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
          </div>
     @endforeach
@endsection

@push('js')
     <script>
          $(function() {
               $('#DataTable').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": false,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true,
               });
          });
     </script>
     <script>
          $(document).on('click', '.delete-jenis-cuti', function(e) {
               e.preventDefault();
               var JenisCutiiId = $(this).attr('data-id');
               var JenisCutiName = $(this).attr('data-namajeniscuti');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk menghapus jenis cuti dengan nama " + JenisCutiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/delete-jenis-cuti/" + JenisCutiiId + "";
                    }
               });
          });
     </script>
     <script type="text/javascript">
          @if ($errors->has('nama_cuti') || $errors->has('type_cuti') || $errors->has('total_hari'))
               $('#TambahJenisCuti').modal('show');
          @endif
     </script>
@endpush
