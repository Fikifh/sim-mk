<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="MK Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{ asset("bower_components/AdminLTE-3.0.5/dist/img/user2-160x160.jpg") }} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">          
          <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->  
          <!-- Admin Menu -->
          @if(Auth::user()->role == 'admin')
            <li class="nav-item">
              <a href={{route('kegiatan')}} class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Kegiatan                
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{route('laporan_kegiatan')}} class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Laporan                
                </p>
              </a>
            </li>
          @else
            <li class="nav-item">
              <a href={{route('kegiatan_pegawai')}} class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Kegiatan                
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href={{route('laporan_pegawai')}} class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Laporan Saya                
                </p>
              </a>
            </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>