@extends('layouts.main')

@section('title')
     Tambah Data Pegawai
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Tambah Data Pegawai</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Form Tambah Data Pegawai</h3>
          </div>
          <div class="card-body">
               <form action="{{ route('insert-pegawai') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-7">
                              <h2 class="mb-3">Data Pribadi</h2>
                              <div class="form-group">
                                   <label>Pas Foto <span style="color: red">*</span></label> <br>
                                   <img id="output_pas_foto" class="img-fluid mb-3" /> <br>
                                   <div class="input-group">
                                        <div class="custom-file">
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
                                   <label>Nama Lengkap <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" value="{{ old('nama_lengkap') }}">
                                   @error('nama_lengkap')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>No. Handphone <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" placeholder="Masukkan Nomor Handphone" value="{{ old('no_hp') }}">
                                   @error('no_hp')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Email <span style="color: red">*</span></label>
                                   <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                                   @error('email')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>NIP <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="Masukkan NIP" value="{{ old('nip') }}">
                                   @error('nip')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>NIK <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" placeholder="Masukkan NIK" value="{{ old('nik') }}">
                                   @error('nik')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Jabatan <span style="color: red">*</span></label>
                                   <select class="form-control @error('jabatan') is-invalid @enderror" name="jabatan">
                                        <option value="" disabled selected>- Pilih Jabatan -</option>
                                        @foreach ($role as $item)
                                             <option value="{{ $item->id }}" {{ old('jabatan') == $item->id ? 'selected' : '' }}>{{ $item->display_name }}</option>
                                        @endforeach
                                   </select>
                                   @error('jabatan')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Pangkat / Gol <span style="color: red">*</span></label>
                                   <select class="form-control @error('pangkat_gol') is-invalid @enderror" name="pangkat_gol">
                                        <option value="" disabled selected>- Pilih Pangkat/Gol -</option>
                                        <option value="Bripka / II-D" {{ old('pangkat_gol') == 'Bripka / II-D' ? 'selected' : '' }}> Bripka / II-D</option>
                                        <option value="Brigadir / II-C" {{ old('pangkat_gol') == 'Brigadir / II-C' ? 'selected' : '' }}> Brigadir / II-C</option>
                                        <option value="IPDA / III-A" {{ old('pangkat_gol') == 'IPDA / III-A' ? 'selected' : '' }}> IPDA / III-A</option>
                                        <option value="KOMBES POL / IV-C" {{ old('pangkat_gol') == 'KOMBES POL / IV-C' ? 'selected' : '' }}> KOMBES POL / IV-C</option>
                                        <option value="Pengatur Tingkat I / (II/D)" {{ old('pangkat_gol') == 'Pengatur Tingkat I / (II/D)' ? 'selected' : '' }}> Pengatur Tingkat I / (II/D)</option>
                                        <option value="PENATA TINGKAT I (III/D)" {{ old('pangkat_gol') == 'PENATA TINGKAT I (III/D)' ? 'selected' : '' }}> PENATA TINGKAT I (III/D)</option>
                                        <option value="PENATA MUDA (III/A)" {{ old('pangkat_gol') == 'PENATA MUDA (III/A)' ? 'selected' : '' }}> PENATA MUDA (III/A)</option>
                                        <option value="PENATA (III/C)" {{ old('pangkat_gol') == 'PENATA (III/C)' ? 'selected' : '' }}> PENATA (III/C)</option>
                                        <option value="PEMBINA (IV/A)" {{ old('pangkat_gol') == 'PEMBINA (IV/A)' ? 'selected' : '' }}> PEMBINA (IV/A)</option>
                                   </select>
                                   @error('pangkat_gol')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Alamat Rumah <span style="color: red">*</span></label>
                                   <textarea class="form-control @error('alamat_rumah') is-invalid @enderror" rows="5" placeholder="Masukkan Alamat Rumah" name="alamat_rumah"> {{ old('alamat_rumah') }}</textarea>
                                   @error('alamat_rumah')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Tempat Lahir <span style="color: red">*</span></label>
                                   <input type="text" class="form-control @error('tempatlahir') is-invalid @enderror" name="tempatlahir" placeholder="Masukkan Tempat Lahir" value="{{ old('tempatlahir') }}">
                                   @error('tempatlahir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Tanggal Lahir <span style="color: red">*</span></label>
                                   <input type="date" class="form-control  @error('tanggallahir') is-invalid @enderror" name="tanggallahir" id="tanggallahir" placeholder="Masukkan Tanggal Lahir" value="{{ old('tanggallahir') }}">
                                   @error('tanggallahir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Jenis Kelamin <span style="color: red">*</span></label>
                                   <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin">
                                        <option value="" disabled selected>- Pilih Jenis Kelamin -</option>
                                        <option value="Pria" {{ old('jenis_kelamin') == 'Pria' ? 'selected' : '' }}>Pria</option>
                                        <option value="Wanita" {{ old('jenis_kelamin') == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                                   </select>
                                   @error('jenis_kelamin')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Agama <span style="color: red">*</span></label>
                                   <select class="form-control @error('agama') is-invalid @enderror" name="agama">
                                        <option value="" disabled selected>- Pilih Agama -</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Kong Hu Chu" {{ old('agama') == 'Kong Hu Chu' ? 'selected' : '' }}>Kong Hu Chu</option>
                                   </select>
                                   @error('agama')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Status Perkawinan <span style="color: red">*</span></label>
                                   <select class="form-control @error('status_perkawinan') is-invalid @enderror" name="status_perkawinan">
                                        <option value="" disabled selected>- Pilih Status -</option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                   </select>
                                   @error('status_perkawinan')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Pendidikan Terakhir <span style="color: red">*</span></label>
                                   <select class="form-control  @error('pendidikan_terakhir') is-invalid @enderror" name="pendidikan_terakhir">
                                        <option value="" disabled selected>- Pilih Pendidikan -</option>
                                        <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                        <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                        <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                        <option value="D1" {{ old('pendidikan_terakhir') == 'D1' ? 'selected' : '' }}>D1</option>
                                        <option value="D2" {{ old('pendidikan_terakhir') == 'D2' ? 'selected' : '' }}>D2</option>
                                        <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                        <option value="S1/D4" {{ old('pendidikan_terakhir') == 'S1/D4' ? 'selected' : '' }}>S1/D4</option>
                                   </select>
                                   @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <h2 class="mb-3 mt-5">Berkas Pribadi</h2>
                              <div class="form-group">
                                   <label>KTP <span style="color: red">*</span></label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input @error('ktp') is-invalid @enderror" accept="application/pdf" name="ktp">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
                                   @error('ktp')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>

                              <div class="form-group">
                                   <label>NPWP <span style="color: red">*</span></label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input @error('npwp') is-invalid @enderror" accept="application/pdf" name="npwp">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
                                   @error('npwp')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>SIM C <span style="color: red">*</span></label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input @error('sim_c') is-invalid @enderror" accept="application/pdf" name="sim_c">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
                                   @error('sim_c')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>SIM A</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input @error('sim_a') is-invalid @enderror" accept="application/pdf" name="sim_a">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
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
                                             <input type="file" class="custom-file-input @error('sim_b') is-invalid @enderror" accept="application/pdf" name="sim_b">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
                                   @error('sim_b')
                                        <div class="invalid-feedback" style="display: block">
                                             {{ $message }}
                                        </div>
                                   @enderror
                              </div>
                              <div class="form-group">
                                   <label>Paspor</label>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input @error('paspor') is-invalid @enderror" accept="application/pdf" name="paspor">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                                   <span class="custom-info-form">File harus format .pdf dan maksimal 2mb</span>
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
     <script>
          const phoneInput = document.getElementById('no_hp');
          phoneInput.addEventListener("input", function(event) {
               const inputValue = event.target.value;
               const cleanedValue = inputValue.replace(/\D/g, ""); // Remove non-digit characters
               event.target.value = cleanedValue;
          });
     </script>
     <script>
          const nipInput = document.getElementById('nip');
          nipInput.addEventListener("input", function(event) {
               const inputValue = event.target.value;
               const cleanedValue = inputValue.replace(/\D/g, ""); // Remove non-digit characters
               event.target.value = cleanedValue;
          });
     </script>
     <script>
          const nikInput = document.getElementById('nik');
          nikInput.addEventListener("input", function(event) {
               const inputValue = event.target.value;
               const cleanedValue = inputValue.replace(/\D/g, ""); // Remove non-digit characters
               event.target.value = cleanedValue;
          });
     </script>
     <script>
          var today = new Date().toISOString().split('T')[0];
          document.getElementById("tanggallahir").setAttribute("max", today);
     </script>
@endpush
