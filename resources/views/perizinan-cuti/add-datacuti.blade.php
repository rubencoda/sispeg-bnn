@extends('layouts.main')

@section('title')
     Formulir Perizinan Cuti
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Formulir Perizinan Cuti</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Form Perizinan Cuti</h3>
          </div>
          <div class="card-body">
               <form action="{{ route('insert-cuti') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-7">
                              <div class="form-group">
                                   <label>NIP/NRP <span style="color: red">*</span></label>
                                   <input type="text" class="form-control" name="nip_nrp" placeholder="Masukkan NIP/NRP" value="{{ $data->nip }}" readonly>
                              </div>
                              <div class="form-group">
                                   <label>Nama Pegawai <span style="color: red">*</span></label>
                                   <input type="text" class="form-control" name="nama_pegawai" placeholder="Masukkan Nama Pegawai" value="{{ $data->nama_lengkap }}" readonly>
                              </div>
                              <div class="form-group">
                                   <label>Jabatan <span style="color: red">*</span></label>
                                   <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jabatan" value="{{ $data->Role->display_name }}" readonly>
                              </div>
                              <div class="form-group">
                                   <label>Jenis Cuti <span style="color: red">*</span></label>
                                   <select class="form-control @error('jenis_cuti') is-invalid @enderror" name="jenis_cuti" id="jenis_cuti">
                                        <option value="" readonly>- Pilih Jenis Cuti -</option>
                                        @foreach ($jeniscuti as $item)
                                             <option value="{{ $item->id }}">{{ $item->nama_cuti }} ({{ $item->total_hari }} Hari)</option>
                                        @endforeach
                                   </select>
                                   @error('jenis_cuti')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group" id="mulai_cuti" style="display: none">
                                   <label>Mulai Cuti <span style="color: red">*</span></label>
                                   <input type="date" class="form-control @error('mulai_cuti') is-invalid @enderror " name="mulai_cuti">
                                   @error('mulai_cuti')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                                   <span class="custom-info-form">Format Penulisan Bulan/Tanggal/Tahun. Contoh : 02/23/2023</span>
                              </div>
                              <div class="form-group">
                                   <label>Catatan Cuti</label>
                                   <input type="text" class="form-control" name="catatan_cuti" placeholder="Masukkan Catatan Cuti">
                              </div>
                              <div class="form-group">
                                   <label>Alamat Selama Cuti <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('alamat_cuti') is-invalid @enderror" name="alamat_cuti" placeholder="Masukkan Alamat Selama Cuti">
                                   @error('alamat_cuti')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                         </div>
                    </div>
                    <div class="row mt-5">
                         <div class="col-12">
                              <div class="float-sm-right">
                                   <button type="submit" class="btn btn-primary">Submit</button>
                                   <a href="#" class="btn btn-secondary" style="margin-right: 5px" onclick="history.back()">Kembali</a>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </div>
@endsection

@push('js')
     <script>
          $(document).ready(function() {
               $("#jenis_cuti").change(function() {
                    var dateInputContainer = $("#mulai_cuti");
                    dateInputContainer.show();
               });
          });
     </script>
@endpush
