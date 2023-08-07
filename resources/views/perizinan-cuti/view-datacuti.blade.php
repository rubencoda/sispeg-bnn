@extends('layouts.main')

@section('title')
     Data Perizinan Cuti
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Data Perizinan Cuti</h1>
               </div>
               <div class="col-sm-6">
                    <div class="float-sm-right">
                         <a href="{{ route('view-jenis-cuti') }}" class="btn btn-primary">Kelola Jenis Cuti</a>
                         <a href="{{ route('view-skb-cuti') }}" class="btn btn-secondary">Kelola SKB Cuti</a>
                    </div>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <!-- Default box -->
     <form action="{{ route('view-cuti') }}" method="GET">
          <div class="row mb-3">
               <div class="col-sm-4">
                    <div class="input-group input-group-md">
                         <input type="text" class="form-control" id="search" name="search" placeholder="Search Nama Pegawai">
                         <span class="input-group-append">
                              <button type="submit" class="btn btn-primary btn-flat"><i class="fa-solid fa-magnifying-glass"></i></button>
                         </span>
                    </div>
               </div>
          </div>
     </form>
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Data Perizinan Cuti</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama</th>
                              <th>NIP</th>
                              <th>Jabatan</th>
                              <th>Jenis Cuti</th>
                              <th>Tanggal Pengajuan</th>
                              <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>{{ $item->nama_pegawai }}</td>
                                   <td>{{ $item->nip }}</td>
                                   <td>{{ $item->jabatan }}</td>
                                   <td>{{ $item->JenisCuti->nama_cuti }} ({{ $item->JenisCuti->total_hari }} Hari)</td>
                                   <td>{{ $item->created_at }}</td>
                                   <td class="text-center">
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#showdetail{{ $item->id }}"><i class="fa-solid fa-eye"></i></button>
                                        @role('KEPALA-BNNK-SIDOARJO')
                                             <a href="{{ route('second-approve', $item->id) }}" class="btn btn-success second-approve" data-id="{{ $item->id }}" data-pegawai="{{ $item->nama_pegawai }}"><i class="fa-solid fa-check"></i></a>
                                        @endrole()
                                        @role('KEPALA-SUB-BAGIAN-UMUM')
                                             <a href="{{ route('first-approve', $item->id) }}" class="btn btn-success first-approve" data-id="{{ $item->id }}" data-pegawai="{{ $item->nama_pegawai }}"><i class="fa-solid fa-check"></i></a>
                                        @endrole()
                                        @role(['KEPALA-BNNK-SIDOARJO', 'KEPALA-SUB-BAGIAN-UMUM'])
                                             <a href="{{ route('rejected-cuti', $item->id) }}" class="btn btn-danger rejected-cuti" data-id="{{ $item->id }}" data-pegawai="{{ $item->nama_pegawai }}"><i class="fa-solid fa-xmark"></i></a>
                                        @endrole()
                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
     <!-- /.card -->

     @foreach ($data as $item)
          {{-- Modal Show Detail --}}
          <div class="modal fade" id="showdetail{{ $item->id }}">
               <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                         <div class="modal-header">
                              <h4 class="modal-title">Detail Data Cuti</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>
                         </div>
                         <div class="modal-body">
                              <div class="form-group">
                                   <label>NIP/NRP</label>
                                   <input type="text" class="form-control" name="nip_nrp" value="{{ $item->nip }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Nama Pegawai</label>
                                   <input type="text" class="form-control" name="nama_pegawai" value="{{ $item->nama_pegawai }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Jabatan</label>
                                   <input type="text" class="form-control" name="jabatan" value="{{ $item->jabatan }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Jenis Cuti</label>
                                   <input type="text" class="form-control" name="jenis_cuti" value="{{ $item->JenisCuti->nama_cuti }} ({{ $item->JenisCuti->total_hari }} Hari)" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Mulai Cuti</label>
                                   <input type="date" class="form-control" name="mulai_cuti" value="{{ $item->mulai_cuti }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Akhir Cuti</label>
                                   <input type="date" class="form-control" name="mulai_cuti" value="{{ $item->akhir_cuti }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Catatan Cuti</label>
                                   <input type="text" class="form-control" name="catatan_cuti" value="{{ $item->catatan_cuti }}" readonly disabled>
                              </div>
                              <div class="form-group">
                                   <label>Alamat Selama Cuti</label>
                                   <textarea class="form-control" name="alamat_cuti" readonly disabled>{{ $item->alamat_cuti }}</textarea>
                              </div>
                         </div>
                         <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                         </div>
                    </div>
                    <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
          </div>
     @endforeach
     <!-- /.modal -->
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
          $(document).on('click', '.first-approve', function(e) {
               e.preventDefault();
               var PegawaiId = $(this).attr('data-id');
               var PegawaiName = $(this).attr('data-pegawai');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk mengkonfirmasi perizinan cuti dengan nama pegawai " + PegawaiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Konfirmasi'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/first-approve/" + PegawaiId + "";
                    }
               });
          });
     </script>
     <script>
          $(document).on('click', '.second-approve', function(e) {
               e.preventDefault();
               var PegawaiId = $(this).attr('data-id');
               var PegawaiName = $(this).attr('data-pegawai');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk mengkonfirmasi perizinan cuti dengan nama pegawai " + PegawaiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Konfirmasi'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/second-approve/" + PegawaiId + "";
                    }
               });
          });
     </script>
     <script>
          $(document).on('click', '.rejected-cuti', function(e) {
               e.preventDefault();
               var PegawaiId = $(this).attr('data-id');
               var PegawaiName = $(this).attr('data-pegawai');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk tidak memberikan perizinan cuti dengan nama pegawai " + PegawaiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Konfirmasi'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/rejected-cuti/" + PegawaiId + "";
                    }
               });
          });
     </script>
@endpush
