		<nav id="header-dekstop" class="navbar navbar-expand navbar-light topbar mb-4 static-top" style="background-color: #6777EF;">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{ asset('assets-ruang-admin/img/boy.png') }}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{ session('user_name') }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
				 <a class="dropdown-item" href="{{ url('page_profile').'/'.session('user_id') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ url('page_logout') }}">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
		
		
		<nav id="header-mobile" class="navbar navbar-expand navbar-light topbar mb-4 static-top" style="background-color: #6777EF;">
			<div class="row">
				<div class="col-sm-12">
					<table style="width: 100%;">
						<tr>
							<td>
							  <a class="nav-item nav-link no-arrow" href="#">
								<img class="img-profile rounded-circle avatar" src="{{ asset('assets-ruang-admin/img/boy.png') }}" style="max-width: 60px">
								&nbsp;&nbsp;<span class="text-white small">{{ session('user_name') }}</span>
							  </a>
							</td>
							<td class="text-right">
							  <a class="btn btn-link rounded-circle mr-3" href="#" id="userDropdown" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false" style="float: right;">
									<i class="fa fa-bars"></i>
							  </a>
								<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
									<a class="dropdown-item" href="{{ url('page_profile').'/'.session('user_id') }}">
									  <i class="fas fa-user fa-sm fa-fw mr-2"></i>
									  Profil
									</a>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-change-password">
									  <i class="fas fa-fw fa-key"></i>
									  <span>Ubah Kata Sandi</span>
									</a>
									<div class="dropdown-divider"></div>
									@if (session('user_role') == 'Admin')
										<a class="dropdown-item" href="{{ url('/Dashboard') }}">
										  <i class="fas fa-fw fa-tachometer-alt"></i>
											<span>Dashboard</span>
										</a>
										<a class="dropdown-item" href="{{ url('/management_of_user') }}">
										  <i class="fas fa-fw fa-user"></i>
										  <span>Kelola Pengguna</span>
										</a>
										<a class="dropdown-item" href="{{ url('/management_of_education') }}">
										  <i class="fas fa-fw fa-book"></i>
										  <span>Kelola File Edukasi</span>
										</a>
										<a class="dropdown-item" href="{{ url('/history_kuesioner') }}">
										  <i class="fas fa-fw fa-history"></i>
										  <span>Kelola Data</span>
										</a>
									@endif
									@if (session('user_role') == 'User' || session('user_role') == 'Dokter Gigi')
										<a class="dropdown-item" href="{{ url('/user-dashboard') }}">
										  <i class="fas fa-fw fa-tachometer-alt"></i>
										  <span>Home</span>
										</a>
										<a class="dropdown-item" href="{{ url('/user-introduction') }}">
										  <i class="fa fa-book" aria-hidden="true"></i>
										  <span>Introduction</span>
										</a>
										<a class="dropdown-item" href="{{ url('/user-kuesioner') }}">
										  <i class="fa fa-history" aria-hidden="true"></i>
										  <span>Histori Data</span>
										</a>
									@endif
									
									<a class="dropdown-item" href="{{ url('page_logout') }}">
									  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
									  Logout
									</a>
								</div>
							</td>
						</tr>
					</table>
				</div>
			</div>
			
		</nav>