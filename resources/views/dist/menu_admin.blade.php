	<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center bg-gradient-success" href="{{ url('/Dashboard') }}">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('assets-ruang-admin/img/drrc-edurisk-crop.png') }}">
        </div>
        <div class="sidebar-brand-text mx-3">SIPERIKAR</div>
      </a>
      <hr class="sidebar-divider my-0">
	  <li class="nav-item">
        <a class="nav-link" href="#" data-toggle="modal" data-target="#modal-change-password">
          <i class="fas fa-fw fa-key"></i>
          <span>Change Password</span></a>
      </li>
      <li class="nav-item <?php echo Request::segment(1) == 'Dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ url('/Dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Menu
      </div>
	  <li class="nav-item <?php echo Request::segment(1) == 'management_of_user' ? 'active' : '' ?>">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-user"></i>
          <span>Management of Users</span>
        </a>
      </li>
	  <li class="nav-item <?php echo Request::segment(1) == 'management_of_questionnaire' ? 'active' : '' ?>">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-book"></i>
          <span>Questionnaire</span>
        </a>
      </li>
	  <li class="nav-item <?php echo Request::segment(1) == 'history_kuesioner' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ url('/history_kuesioner') }}">
          <i class="fas fa-fw fa-history"></i>
          <span>History of Questionnaire</span>
        </a>
      </li>
      <hr class="sidebar-divider">
      
      <div class="version">Version 2.0</div>
    </ul>