<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon" />
    <title>PSC | Dashboard</title>
    @include('dist.css')
  </head>

  <body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
      @include('dist.menu_admin')
      <!-- Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- TopBar -->
          @include('dist.header')
          <!-- Topbar -->

          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800"><?php echo Request::segment(1) == 'Dashboard' ? 'Dashboard' : 'Change Password' ?></h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Patient Safety Culture</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo Request::segment(1) == 'Dashboard' ? 'Dashboard' : 'Change Password' ?></li>
              </ol>
            </div>
            <!-- Content Body -->
            <?php if (isset($crud_result)) {
				if ($crud_result == 1) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h6><i class="fas fa-check"></i><b> Success!</b></h6>
              <?php echo $crud_message ?>
            </div>
            <?php } else if($crud_result == 0) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h6><i class="fas fa-ban"></i><b> Failed!</b></h6>
              <?php echo $crud_message ?>
            </div>
            <?php }} ?>
			
			<div class="row">
				<div class="col-sm-12" style="">
					<center>
					<img src="{{ asset('assets/image/img_cover_dashboard.jpeg') }}" alt="" width="80%" height="auto" >
					</center>
				</div>
			</div>
            <!-- End Content Body -->
          </div>
          <!---Container Fluid-->
        </div>

        <!-- Footer -->
        @include('dist.footer')
        <!-- End Footer -->
      </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    @include('dist.js')
  </body>
</html>
