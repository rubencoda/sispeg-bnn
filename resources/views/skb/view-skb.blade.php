@extends('layouts.main')

@section('title')
     SKB Cuti
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>SKB Cuti</h1>
               </div>
               <div class="col-sm-6">
                    <div class="float-sm-right">
                         <button class="btn btn-primary" data-toggle="modal" data-target="#TambahSKBCuti">Tambah SKB Cuti</button>
                    </div>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <!-- Default box -->
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">SKB Cuti</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama SKB</th>
                              <th>Tanggal SKB</th>
                              <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>
                                        {{ $item->nama_skb }}
                                   </td>
                                   <td>
                                        {{ $item->tanggal_skb }}
                                   </td>
                                   <td class="text-center">
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#ShowSKBCuti{{ $item->id }}"><i class="fas fa-edit"></i></a>
                                        <a href="#" class="btn btn-danger delete-skb-cuti" data-id="{{ $item->id }}" data-namaskbcuti="{{ $item->nama_skb }}"><i class="fas fa-trash"></i></a>
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
     <!-- /.card -->

     {{-- Modal Tambah Jenis Cuti --}}
     <div class="modal fade" id="TambahSKBCuti">
          <div class="modal-dialog modal-md">
               <div class="modal-content">
                    <div class="modal-header">
                         <h4 class="modal-title">Tambah SKB Cuti</h4>
                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>
                    </div>
                    <form action="{{ route('store-skb-cuti') }}" method="POST">
                         @csrf
                         <div class="modal-body">
                              <div class="form-group">
                                   <label>Nama SKB Cuti <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('nama_skb_cuti') is-invalid @enderror" name="nama_skb_cuti">
                                   @error('nama_skb_cuti')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Tanggal SKB Cuti <span style="color: red">*</span></label>
                                   <input type="date" class="form-control @error('tgl_skb_cuti') is-invalid @enderror " name="tgl_skb_cuti">
                                   @error('tgl_skb_cuti')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                                   <span class="custom-info-form">Format Penulisan Bulan/Tanggal/Tahun. Contoh : 02/23/2023</span>
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
          <div class="modal fade" id="ShowSKBCuti{{ $item->id }}">
               <div class="modal-dialog modal-md">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title">Edit Jenis Cuti</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                         <form action="{{ route('update-skb-cuti') }}" method="POST">
                              @csrf
                              @method('PUT')
                              <input type="hidden" name="id_skb_cuti" value="{{ $item->id }}">
                              <div class="modal-body">
                                   <div class="form-group">
                                        <label>Nama SKB Cuti <span style="color: red">*</span></label>
                                        <input type="text" class="form-control @error('nama_skb_cuti') is-invalid @enderror" name="nama_skb_cuti" value="{{ $item->nama_skb }}">
                                        @error('nama_skb_cuti')
                                             <div class="invalid-feedback">
                                                  {{ $message }}
                                             </div>
                                        @enderror
                                   </div>
                                   <div class="form-group">
                                        <label>Tanggal SKB Cuti <span style="color: red">*</span></label>
                                        <input type="date" class="form-control @error('tgl_skb_cuti') is-invalid @enderror " name="tgl_skb_cuti" value="{{ $item->tanggal_skb }}">
                                        @error('tgl_skb_cuti')
                                             <div class="invalid-feedback">
                                                  {{ $message }}
                                             </div>
                                        @enderror
                                        <span class="custom-info-form">Format Penulisan Bulan/Tanggal/Tahun. Contoh : 02/23/2023</span>
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
          $(document).on('click', '.delete-skb-cuti', function(e) {
               e.preventDefault();
               var SKBCutiiId = $(this).attr('data-id');
               var SKBCutiName = $(this).attr('data-namaskbcuti');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk menghapus SKB cuti dengan nama " + SKBCutiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/delete-skb-cuti/" + SKBCutiiId + "";
                    }
               });
          });
     </script>
     <script type="text/javascript">
          @if ($errors->has('nama_skb_cuti') || $errors->has('tgl_skb_cuti'))
               $('#TambahSKBCuti').modal('show');
          @endif
     </script>
@endpush
