@extends('layouts.main')

@section('title')
     Tanda Tangan Kepala Cabang
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Tanda Tangan Kepala Cabang</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="card">
          <div class="card-header">
               <h3 class="card-title">Form Tanda Tangan Kepala Cabang</h3>
          </div>
          <div class="card-body">
               <form action="{{ route('update-ttd-kc') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                         <div class="col-7">
                              <div class="form-group">
                                   <label>Tanda Tangan</label> <br>
                                   <img src="{{ asset('storage/ttd/ttd_kepalacabang.PNG') }}" id="output_ttd_kepalacabang" class="img-fluid mb-3" /> <br>
                                   <div class="input-group">
                                        <div class="custom-file">
                                             <input type="file" class="custom-file-input" accept="image/*" id="ttd_kepalacabang" name="ttd_kepalacabang">
                                             <label class="custom-file-label">Upload File</label>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="row mt-5">
                         <div class="col-12">
                              <div class="float-sm-right">
                                   <button type="submit" class="btn btn-primary">Simpan Data</button>
                                   <a href="#" class="btn btn-secondary" style="margin-right: 5px">Kembali</a>
                              </div>
                         </div>
                    </div>
               </form>
          </div>
     </div>
@endsection

@push('css')
     <style>
          #output_ttd_kepalacabang {
               width: 180px;
               height: 200px;
               object-fit: cover;
               background-position: center center;
          }
     </style>
@endpush

@push('js')
     <script>
          let uploadButton = document.getElementById('ttd_kepalacabang');
          let chooseImage = document.getElementById('output_ttd_kepalacabang');

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
