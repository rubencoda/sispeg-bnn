@extends('layouts.main')

@section('title')
     Presensi Kehadiran
@endsection

@section('content-header')
     <div class="container-fluid">
          <div class="row mb-2">
               <div class="col-sm-6">
                    <h1>Presensi Kehadiran</h1>
               </div>
          </div>
     </div>
@endsection

@section('content')
     <div class="text-center">
          <div class="row">
               <div class="col-12">
                    <p>Presensi kehadiran untuk check-in harus dilakukan sebelum pukul 07:00 dan check-out dapat dilakukan setelah pukul 17:00</p>
                    @if ($showCheckin)
                         <a href="{{ route('checkin-presensi') }}" class="btn btn-success mb-2">Check-in</a>
                    @endif
                    @if ($showCheckout)
                         <a href="{{ route('checkout-presensi') }}" class="btn btn-warning">Check-out</a>
                    @endif
               </div>
          </div>
     </div>
@endsection
