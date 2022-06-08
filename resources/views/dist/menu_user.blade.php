	<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar" >
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gradient-primary" href="{{ url('/user-dashboard') }}">
        <div class="sidebar-brand-icon">
          {{-- <img src="{{ asset('assets-ruang-admin/img/pdgi.png') }}"> --}}
        </div>
        <div class="sidebar-brand-text mx-3">{{env('APP_NAME')}}</div>
      </a>
      <hr class="sidebar-divider my-0">
	  <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-change-password">
          <i class="fas fa-fw fa-key"></i>
          <span>Ubah Kata Sandi</span></a>
      </li>
      <li class="nav-item <?php echo Request::segment(1) == 'user-dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ url('/user-dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Home</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
		
	  <li class="nav-item <?php echo Request::segment(1) == 'user-introduction' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ url('/user-introduction') }}">
          <i class="fa fa-book" aria-hidden="true"></i>
          <span>Introduction</span>
        </a>
      </li>
		
      <li class="nav-item <?php echo Request::segment(1) == 'user-kuesioner' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ url('/user-kuesioner') }}">
          <i class="fa fa-history" aria-hidden="true"></i>
          <span>Histori Data</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      
      <div class="version">Version 1.0</div>
    </ul>