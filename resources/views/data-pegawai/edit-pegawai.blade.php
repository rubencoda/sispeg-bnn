@extends('layouts.main')

@section('title')
     Edit Data Pagawai
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Edit Data Pegawai</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Form Edit Data Pegawai</h3>
          </div>
          <div class="card-body">
               <form action="{{ route('update-pegawai') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                         <div class="col-7">
                              <h2 class="mb-3">Data Pribadi</h2>
                              <input type="hidden" name="data_id" value="{{ $data->id }}">
                              <div class="form-group">
                                   <label>Pas Foto</label> <br>
                                   <img src="{{ asset('storage/' . $data->pas_foto) }}" id="output_pas_foto" class="img-fluid mb-3" /> <br>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_pas_foto" value="{{ $data->pas_foto }}">
                                             <input type="file" class="custom-file-input @error('pas_foto') is-invalid @enderror" accept="image/*" id="pas_foto" name="pas_foto">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('pas_foto')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Nama Lengkap</label>
                                   <input type="hidden" name="old_nama_lengkap" value="{{ $data->nama_lengkap }}">
                                   <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="{{ $data->nama_lengkap }}">
                                   @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>No. Handphone</label>
                                   <input type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" placeholder="Masukkan Nomor Handphone" value="{{ $data->no_hp }}">
                                   @error('no_hp')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Email</label>
                                   <input type="hidden" name="old_email" value="{{ $data->email }}">
                                   <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ $data->email }}">
                                   @error('email')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>NIP</label>
                                   <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" placeholder="Masukkan NIP" value="{{ $data->nip }}">
                                   @error('nip')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>NIK</label>
                                   <input type="text" class="form-control @error('nik') is-invalid @enderror" name="nik" placeholder="Masukkan NIK" value="{{ $data->nik }}">
                                   @error('nik')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Jabatan</label>
                                   <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan">
                                        <option value="" disabled selected>- Pilih Jabatan -</option>
                                        @foreach ($role as $item)
                                             <option value="{{ $item->id }}" {{ $data->role_id == $item->id ? 'selected' : '' }}>{{ $item->display_name }}</option>
                                        @endforeach
                                   </select>
                                   @error('jabatan')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Pangkat / Gol</label>
                                   <select class="form-control @error('pangkat_gol') is-invalid @enderror" name="pangkat_gol">
                                        <option value="" disabled selected>- Pilih Pangkat/Gol -</option>
                                        <option value="Bripka / II-D" {{ $data->pangkat_gol == 'Bripka / II-D' ? 'selected' : '' }}> Bripka / II-D</option>
                                        <option value="Brigadir / II-C" {{ $data->pangkat_gol == 'Brigadir / II-C' ? 'selected' : '' }}> Brigadir / II-C</option>
                                        <option value="IPDA / III-A" {{ $data->pangkat_gol == 'IPDA / III-A' ? 'selected' : '' }}> IPDA / III-A</option>
                                        <option value="KOMBES POL / IV-C" {{ $data->pangkat_gol == 'KOMBES POL / IV-C' ? 'selected' : '' }}> KOMBES POL / IV-C</option>
                                        <option value="Pengatur Tingkat I / (II/D)" {{ $data->pangkat_gol == 'Pengatur Tingkat I / (II/D)' ? 'selected' : '' }}> Pengatur Tingkat I / (II/D)</option>
                                        <option value="PENATA TINGKAT I (III/D)" {{ $data->pangkat_gol == 'PENATA TINGKAT I (III/D)' ? 'selected' : '' }}> PENATA TINGKAT I (III/D)</option>
                                        <option value="PENATA MUDA (III/A)" {{ $data->pangkat_gol == 'PENATA MUDA (III/A)' ? 'selected' : '' }}> PENATA MUDA (III/A)</option>
                                        <option value="PENATA (III/C)" {{ $data->pangkat_gol == 'PENATA (III/C)' ? 'selected' : '' }}> PENATA (III/C)</option>
                                        <option value="PEMBINA (IV/A)" {{ $data->pangkat_gol == 'PEMBINA (IV/A)' ? 'selected' : '' }}> PEMBINA (IV/A)</option>
                                   </select>
                                   @error('pangkat_gol')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Alamat Rumah</label>
                                   <textarea class="form-control @error('alamat_rumah') is-invalid @enderror" rows="5" placeholder="Masukkan Alamat Rumah" name="alamat_rumah">{{ $data->alamat_rumah }}</textarea>
                                   @error('alamat_rumah')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Tempat Lahir</label>
                                   <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror" name="tempatlahir" placeholder="Masukkan Tempat Lahir" value="{{ $tempatlahir }}">
                                   @error('tempatlahir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Tanggal Lahir</label>
                                   <input type="date" class="form-control  @error('tanggallahir') is-invalid @enderror" name="tanggallahir" placeholder="Masukkan Tanggal Lahir" value="{{ $tanggallahir }}">
                                   @error('tanggallahir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Jenis Kelamin</label>
                                   <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value="" disabled selected>- Pilih Jenis Kelamin -</option>
                                        <option value="Pria" {{ $data->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                                        <option value="Wanita" {{ $data->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                   </select>
                                   @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Agama</label>
                                   <select class="form-control @error('agama') is-invalid @enderror" name="agama">
                                        <option value="" disabled selected>- Pilih Agama -</option>
                                        <option value="Islam" {{ $data->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ $data->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Hindu" {{ $data->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ $data->agama == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Katolik" {{ $data->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Kong Hu Chu" {{ $data->agama == 'Kong Hu Chu' ? 'selected' : '' }}>Kong Hu Chu</option>
                                   </select>
                                   @error('agama')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Status Perkawinan</label>
                                   <select class="form-control @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan">
                                        <option value="" disabled selected>- Pilih Status -</option>
                                        <option value="Kawin" {{ $data->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Belum Kawin" {{ $data->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Cerai Hidup" {{ $data->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ $data->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                   </select>
                                   @error('status_perkawinan')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Pendidikan Terakhir</label>
                                   <select class="form-control  @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir">
                                        <option value="" disabled selected>- Pilih Pendidikan -</option>
                                        <option value="SD" {{ $data->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ $data->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA/SMK" {{ $data->pendidikan_terakhir == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D1" {{ $data->pendidikan_terakhir == 'D1' ? 'selected' : '' }}>D1</option>
                                        <option value="D2" {{ $data->pendidikan_terakhir == 'D2' ? 'selected' : '' }}>D2</option>
                                        <option value="D3" {{ $data->pendidikan_terakhir == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1/D4" {{ $data->pendidikan_terakhir == 'S1/D4' ? 'selected' : '' }}>S1/D4</option>
                                   </select>
                                   @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <h2 class="mb-3 mt-5">Berkas Pribadi</h2>
                              <div class="form-group">
                                   <label>KTP</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_ktp" value="{{ $data->ktp }}">
                                             <input type="file" class="custom-file-input @error('ktp') is-invalid @enderror" accept="application/pdf" name="ktp">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('ktp')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>

                              <div class="form-group">
                                   <label>NPWP</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_npwp" value="{{ $data->npwp }}">
                                             <input type="file" class="custom-file-input @error('npwp') is-invalid @enderror" accept="application/pdf" name="npwp">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('npwp')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>SIM A</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_sim_a" value="{{ $data->sim_a }}">
                                             <input type="file" class="custom-file-input @error('sim_a') is-invalid @enderror" accept="application/pdf" name="sim_a">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('sim_a')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>SIM B</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_sim_b" value="{{ $data->sim_b }}">
                                             <input type="file" class="custom-file-input @error('sim_b') is-invalid @enderror" accept="application/pdf" name="sim_b">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('sim_b')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>SIM C</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_sim_c" value="{{ $data->sim_c }}">
                                             <input type="file" class="custom-file-input @error('sim_c') is-invalid @enderror" accept="application/pdf" name="sim_c">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('sim_c')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Paspor</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="hidden" name="old_paspor" value="{{ $data->paspor }}">
                                             <input type="file" class="custom-file-input @error('paspor') is-invalid @enderror" accept="application/pdf" name="paspor">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   @error('paspor')
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
                                   <button type="submit" class="btn btn-primary">Simpan Data</button>
                                   <a href="{{ route('view-pegawai') }}" class="btn btn-secondary" style="margin-right: 5px">Kembali</a>
                              </div>
                         </div>
                    </div>
               </form>
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

@push('js')
     <script>
          let uploadButton = document.getElementById('pas_foto');
          let chooseImage = document.getElementById('output_pas_foto');

          uploadButton.onchange = () => {
               let reader = new FileReader();
               reader.readAsDataURL(uploadButton.files[0]);
               console.log(uploadButton.files[0]);
               reader.onload = () => {
                    chooseImage.setAttribute('src', reader.result);
               }
          }
     </script>
@endpush
