@extends('layouts.main')

@section('title')
     Profile Pegawai
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Profile Pegawai</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Profile Pegawai</h3>
          </div>
          <div class="card-body">
               <div class="row">
                    <div class="col-7">
                         <h2 class="mb-3">Data Pribadi</h2>
                         <div class="form-group">
                              <label>Pas Foto</label> <br>
                              <img src="{{ asset('storage/' . $data->pas_foto) }}" id="output_pas_foto" class="img-fluid mb-3" /> <br>
                         </div>
                         <div class="form-group">
                              <label>Nama Lengkap</label>
                              <input type="text" class="form-control" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="{{ $data->nama_lengkap }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>No. Handphone</label>
                              <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone" value="{{ $data->no_hp }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Email</label>
                              <input type="email" class="form-control" name="email" placeholder="Masukkan Email" value="{{ $data->email }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>NIP</label>
                              <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ $data->nip }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>NIK</label>
                              <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK" value="{{ $data->nik }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Jabatan</label>
                              <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan" value="{{ $data->Role->display_name }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Pangkat / Gol</label>
                              <input type="text" class="form-control" id="pangkat_gol" name="pangkat_gol" placeholder="Masukkan Pangkat / Gol" value="{{ $data->pangkat_gol }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Alamat Rumah</label>
                              <textarea class="form-control" rows="5" placeholder="Masukkan Alamat Rumah" name="alamat_rumah" disabled>{{ $data->alamat_rumah }}</textarea>
                         </div>
                         <div class="form-group">
                              <label>Tanggal Lahir</label>
                              <input type="text" class="form-control" name="tanggallahir" placeholder="Masukkan Tanggal Lahir" value="{{ $data->ttl }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Jenis Kelamin</label>
                              <input type="text" class="form-control" name="jeniskelamin" placeholder="Masukkan Jenis Kelamin" value="{{ $data->jenis_kelamin }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Agama</label>
                              <input type="text" class="form-control" name="agama" placeholder="Masukkan agama" value="{{ $data->agama }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Status Perkawinan</label>
                              <input type="text" class="form-control" name="status_perkawinan" placeholder="Masukkan Status Perkawinan" value="{{ $data->status_perkawinan }}" disabled>
                         </div>
                         <div class="form-group">
                              <label>Pendidikan Terakhir</label>
                              <input type="text" class="form-control" name="pendidikan_terakhir" placeholder="Masukkan Pendidikan Terakhir" value="{{ $data->pendidikan_terakhir }}" disabled>
                         </div>
                         @if ($data->ktp != null)
                              <div class="form-group">
                                   <label>File KTP</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->ktp)) }}">Download File KTP</a>
                              </div>
                         @endif
                         @if ($data->npwp != null)
                              <div class="form-group">
                                   <label>File NPWP</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->npwp)) }}">Download File NPWP</a>
                              </div>
                         @endif
                         @if ($data->sim_a != null)
                              <div class="form-group">
                                   <label>File SIM A</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->sim_a)) }}">Download File SIM A</a>
                              </div>
                         @endif
                         @if ($data->sim_b != null)
                              <div class="form-group">
                                   <label>File SIM B</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->sim_b)) }}">Download File SIM B</a>
                              </div>
                         @endif
                         @if ($data->sim_c != null)
                              <div class="form-group">
                                   <label>File SIM C</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->sim_c)) }}">Download File SIM C</a>
                              </div>
                         @endif
                         @if ($data->paspor != null)
                              <div class="form-group">
                                   <label>File Paspor</label><br>
                                   <a href="{{ route('download-file', str_replace('/', '&', $data->paspor)) }}">Download File Paspor</a>
                              </div>
                         @endif

                    </div>
               </div>
               <div class="row mt-5">
                    <div class="col-12">
                         <div class="float-sm-right">
                              <button onclick="history.back()" class="btn btn-secondary" style="margin-right: 5px">Kembali</button>
                         </div>
                    </div>
               </div>
          </div>
     </div>
@endsection

@push('css')
     <style>
          #output_pas_foto {
               width: 180px;
               height: 200px;
               object-fit: cover;
               background-position: center center;
          }
     </style>
@endpush
