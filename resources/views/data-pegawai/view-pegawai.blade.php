@extends('layouts.main')

@section('title')
     Data Pegawai
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Data Pegawai</h1>
               </div>
               <div class="col-sm-6">
                    <div class="float-sm-right">
                         <a href="{{ route('add-pegawai') }}" class="btn btn-primary">Tambah Data Pegawai</a>
                         <a href="{{ route('export-pegawai') }}" class="btn btn-info">Export Excel</a>
                    </div>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <!-- Default box -->
     <form action="{{ route('view-pegawai') }}" method="GET">
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
               <h3 class="card-title">Data Pegawai</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama</th>
                              <th>NIP</th>
                              <th>Pangkat / Gol. Ruang</th>
                              <th>Jabatan</th>
                              <th>No. HP</th>
                              <th>Status</th>
                              <th>Action</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>{{ $item->nama_lengkap }}</td>
                                   <td>{{ $item->nip }}</td>
                                   <td>{{ $item->pangkat_gol }}</td>
                                   <td>{{ $item->Role->display_name }}</td>
                                   <td>{{ $item->no_hp }}</td>
                                   @if ($item->is_active == 'true')
                                        <td>Aktif</td>
                                   @else
                                        <td>Tidak Aktif</td>
                                   @endif

                                   <td class="text-center">
                                        <a href="{{ route('edit-pegawai', $item->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                        @if ($item->is_active == 'true')
                                             <a href="{{ route('delete-pegawai', $item->id) }}" class="btn btn-danger delete-pegawai" data-id="{{ $item->id }}" data-pegawai="{{ $item->nama_lengkap }}"><i class="fas fa-trash"></i></a>
                                        @else
                                             <a href="{{ route('restore-pegawai', $item->id) }}" class="btn btn-success restore-pegawai" data-id="{{ $item->id }}" data-pegawai="{{ $item->nama_lengkap }}"><i class="fas fa-recycle"></i></a>
                                        @endif

                                   </td>
                              </tr>
                         @endforeach
                    </tbody>
               </table>
          </div>
     </div>
     <!-- /.card -->
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
          $(document).on('click', '.delete-pegawai', function(e) {
               e.preventDefault();
               var PegawaiId = $(this).attr('data-id');
               var PegawaiName = $(this).attr('data-pegawai');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk menghapus data pegawai dengan nama " + PegawaiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/delete-pegawai/" + PegawaiId + "";
                    }
               });
          });
     </script>
     <script>
          $(document).on('click', '.restore-pegawai', function(e) {
               e.preventDefault();
               var PegawaiId = $(this).attr('data-id');
               var PegawaiName = $(this).attr('data-pegawai');

               Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Untuk mengaktifkan data pegawai dengan nama " + PegawaiName + "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aktifkan'
               }).then((result) => {
                    if (result.isConfirmed) {
                         window.location = "/restore-pegawai/" + PegawaiId + "";
                    }
               });
          });
     </script>
@endpush
