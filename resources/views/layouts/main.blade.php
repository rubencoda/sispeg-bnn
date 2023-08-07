<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>@yield('title')</title>
     <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-bnn.png') }}">

     @include('inc.ext-css')
     @stack('css')
</head>

<body class="hold-transition sidebar-mini">
     <!-- Site wrapper -->
     <div class="wrapper">
          @include('layouts.navbar')

          @include('layouts.sidebar')

          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
               <!-- Content Header (Page header) -->
               <section class="content-header">
                    @yield('content-header')
               </section>

               <!-- Main content -->
               <section class="content">

                    @yield('content')

               </section>
               <!-- /.content -->
          </div>
          <!-- /.content-wrapper -->

          @include('layouts.footer')

          <!-- Control Sidebar -->
          {{-- <aside class="control-sidebar control-sidebar-dark">
               <!-- Control sidebar content goes here -->
          </aside> --}}
          <!-- /.control-sidebar -->
     </div>
     <!-- ./wrapper -->

     @include('layouts.change-password')

     @include('inc.ext-js')
     @stack('js')
</body>

</html>
