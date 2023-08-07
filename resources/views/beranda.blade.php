@extends('layouts.main')

@section('title')
     Beranda
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Beranda</h1>
               </div>
               {{-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
               </div> --}}
          </div>


     </div>
@endsection

@section('content')
     <div class="container-fluid">


          <div class="row">
               <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                         <div class="inner">
                              <h3>{{ $pegawai }}</h3>

                              <p>Seluruh Pegawai</p>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-user-group" style="font-size: 60px; top: 25px"></i>
                         </div>
                    </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                         <div class="inner">
                              <h3>{{ $onduty }}</h3>

                              <p>Pegawai On Duty</p>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-user-group" style="font-size: 60px; top: 25px"></i>
                         </div>
                    </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                         <div class="inner">
                              <h3>{{ $cuti }}</h3>

                              <p>Pegawai Cuti</p>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-user-group" style="font-size: 60px; top: 25px"></i>
                         </div>
                    </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                         <div class="inner">
                              <h3>{{ $offduty }}</h3>

                              <p>Pegawai Off Duty</p>
                         </div>
                         <div class="icon">
                              <i class="fa-solid fa-user-group" style="font-size: 60px; top: 25px"></i>
                         </div>
                    </div>
               </div>
               <!-- ./col -->
          </div>
     </div>
@endsection
