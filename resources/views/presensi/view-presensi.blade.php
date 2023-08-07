@extends('layouts.main')

@section('title')
     Data Presensi Pegawai
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Data Presensi Pegawai</h1>
               </div>
               <div class="col-sm-6">
                    <div class="float-sm-right">
                         <form action="{{ route('export-presensi') }}" method="GET">
                              <div class="input-group">
                                   <input type="month" class="form-control mr-2" name="month" required>
                                   <div class="input-group-append">
                                        <button type="submit" class="btn btn-info">Export Excel</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <!-- Default box -->
     <form action="{{ route('data-presensi') }}" method="GET">
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
               <h3 class="card-title">Data Presensi Pegawai</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama Pegawai</th>
                              <th>Check - in</th>
                              <th>Check - out</th>
                              <th>Keterangan</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>{{ $item->Pegawai->nama_lengkap }}</td>
                                   <td>{{ \Carbon\Carbon::parse($item->check_in)->format('d F Y - H:i') }}</td>
                                   <td>{{ \Carbon\Carbon::parse($item->check_out)->format('d F Y - H:i') }}</td>
                                   <td>{{ $item->keterangan }}</td>
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
@endpush
