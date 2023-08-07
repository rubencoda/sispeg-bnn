 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('beranda') }}" class="brand-link">
           {{-- <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
           <div class="text-center">
                <span class="brand-text font-weight-light">SISPEG BNN</span>
           </div>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
           {{-- <!-- Sidebar user (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                     <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                     <a href="#" class="d-block">Alexander Pierce</a>
                </div>
           </div> --}}

           <!-- Sidebar Menu -->
           <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
    with font-awesome or any other icon font library -->
                     <li class="nav-item">
                          <a href="{{ route('beranda') }}" class="nav-link">
                               <i class="nav-icon fa-solid fa-house"></i>
                               <p>Beranda</p>
                          </a>
                     </li>
                     <li class="nav-item">
                          <a href="#" class="nav-link">
                               <i class="nav-icon fa-sharp fa-solid fa-file-invoice"></i>
                               <p>Data Perizinan Cuti</p>
                               <i class="fas fa-angle-left right"></i>
                          </a>
                          <ul class="nav nav-treeview">
                               @role(['superadmin', 'KEPALA-SUB-BAGIAN-UMUM', 'KEPALA-BNNK-SIDOARJO'])
                                    <li class="nav-item">
                                         <a href="{{ route('view-cuti') }}" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>Data Perizinan Cuti</p>
                                         </a>
                                    </li>
                               @endrole()
                               @role('KEPALA-BNNK-SIDOARJO')
                                    <li class="nav-item">
                                         <a href="{{ route('history-cuti') }}" class="nav-link">
                                              <i class="far fa-circle nav-icon"></i>
                                              <p>History Perizinan Cuti</p>
                                         </a>
                                    </li>
                               @endrole()
                               <li class="nav-item">
                                    <a href="{{ route('add-cuti') }}" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Formulir Perizinan Cuti</p>
                                    </a>
                               </li>
                               <li class="nav-item">
                                    <a href="{{ route('status-cuti') }}" class="nav-link">
                                         <i class="far fa-circle nav-icon"></i>
                                         <p>Status Perizinan Cuti</p>
                                    </a>
                               </li>
                          </ul>
                     </li>
                     @role(['superadmin', 'PENGELOLA-DATA-SUB-BAGIAN-UMUM'])
                          <li class="nav-item">
                               <a href="{{ route('view-pegawai') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-users"></i>
                                    <p>Data Pegawai</p>
                               </a>
                          </li>
                          <li class="nav-item">
                               <a href="{{ route('data-presensi') }}" class="nav-link">
                                    <i class="nav-icon fa-solid fa-list"></i>
                                    <p>Data Presensi Pegawai</p>
                               </a>
                          </li>
                     @endrole()
                </ul>
           </nav>
           <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
 </aside>
