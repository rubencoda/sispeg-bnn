<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     {{-- <ul class="navbar-nav">
          <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
     </ul> --}}

     <!-- Right navbar links -->
     <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-user"></i> {{ Auth::user()->name }}
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a class="dropdown-item" href="{{ route('profile-pegawai', Auth::user()->id) }}">
                         Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('view-presensi') }}">
                         Presensi
                    </a>
                    <div class="dropdown-divider"></div>
                    <button class="dropdown-item" data-toggle="modal" data-target="#change-password">
                         Change Password
                    </button>
                    @role('KEPALA-BNNK-SIDOARJO')
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="{{ route('view-ttd-kepalacabang') }}">
                              Update Tanda Tangan
                         </a>
                    @endrole()
                    @role('KEPALA-SUB-BAGIAN-UMUM')
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="{{ route('view-ttd-kasubag') }}">
                              Update Tanda Tangan
                         </a>
                    @endrole()
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                         Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                    </form>
               </div>
          </li>
     </ul>
</nav>
<!-- /.navbar -->
