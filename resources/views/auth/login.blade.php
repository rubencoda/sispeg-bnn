<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>SISPEG BNNK Sidoarjo</title>
     <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-bnn.png') }}">
     <!-- Google Font: Source Sans Pro -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
     <!-- Font Awesome -->
     <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/fontawesome-free/css/all.min.css') }}">
     <!-- icheck bootstrap -->
     <link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
     <!-- Theme style -->
     <link rel="stylesheet" href="{{ asset('/AdminLTE/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition login-page">
     <div class="login-logo" style="margin-bottom: 0">
          <img src="{{ asset('assets/img/logo-bnn.png') }}" style="width: 120px" alt="">
          <div>
               <b>Sistem Informasi Kepegawaian</b>
               <p>Badan Narkotika Nasional Kabupaten Sidoarjo</p>
          </div>
     </div>
     @if ($errors->has('status'))
          <div class="alert alert-danger alert-dismissible">
               <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               <h5><i class="icon fas fa-ban"></i> Alert!</h5>
               {{ $errors->first('status') }}
          </div>
     @endif
     <div class="login-box">
          <!-- /.login-logo -->
          <div class="card">
               <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                    <form action="{{ route('login') }}" method="post">
                         @csrf
                         <div class="input-group mb-3">
                              <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="Email" required autocomplete="email" autofocus>
                              <div class="input-group-append">
                                   <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                   </div>
                              </div>
                              @error('email')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                   </span>
                              @enderror
                         </div>
                         <div class="input-group mb-3">
                              <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="current-password">
                              <div class="input-group-append">
                                   <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                   </div>
                              </div>
                              @error('password')
                                   <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                   </span>
                              @enderror
                         </div>
                         <div class="row">
                              {{-- <div class="col-8">
                                   <div class="icheck-primary">
                                        <input type="checkbox" id="remember">
                                        <label for="remember">
                                             Remember Me
                                        </label>
                                   </div>
                              </div> --}}
                              <!-- /.col -->
                              <div class="col-4">
                                   <button type="submit" class="btn btn-primary btn-block float-left">Sign In</button>
                              </div>
                              <!-- /.col -->
                         </div>
                    </form>
                    {{-- <p class="mb-1">
                         <a href="forgot-password.html">I forgot my password</a>
                    </p>
                    <p class="mb-0">
                         <a href="register.html" class="text-center">Register a new membership</a>
                    </p> --}}
               </div>
               <!-- /.login-card-body -->
          </div>
     </div>
     <!-- /.login-box -->

     <!-- jQuery -->
     <script src="{{ asset('/AdminLTE/plugins/jquery/jquery.min.js') }}"></script>
     <!-- Bootstrap 4 -->
     <script src="{{ asset('/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
     <!-- AdminLTE App -->
     <script src="{{ asset('/AdminLTE/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
