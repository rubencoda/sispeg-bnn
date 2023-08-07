@extends('layouts.main')

@section('title')
     Status Perizinan Cuti
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Status Perizinan Cuti</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Status Perizinan Cuti</h3>
          </div>
          <div class="card-body">
               <table id="DataTable" class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <th>Nama</th>
                              <th>Jabatan</th>
                              <th>Jenis Cuti</th>
                              <th>Status Cuti</th>
                              <th>Tanggal Pengajuan</th>
                         </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $item)
                              <tr>
                                   <td>{{ $item->nama_pegawai }}</td>
                                   <td>{{ $item->jabatan }}</td>
                                   <td>{{ $item->JenisCuti->nama_cuti }}</td>
                                   <td>
                                        @if ($item->status_cuti == 'Need Approval 1' || $item->status_cuti == 'Need Approval 2')
                                             <span class="badge bg-warning font-badge">{{ $item->status_cuti }}</span>
                                        @elseif($item->status_cuti == 'Approved')
                                             <span class="badge bg-success font-badge">{{ $item->status_cuti }}</span>
                                        @elseif ($item->status_cuti == 'Rejected')
                                             <span class="badge bg-danger font-badge">{{ $item->status_cuti }}</span>
                                        @endif
                                   </td>
                                   <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}</td>
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
