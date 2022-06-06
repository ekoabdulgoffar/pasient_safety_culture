<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon">
  <title>{{env('APP_NAME')}} | Users DIstribution Detail</title>
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
            <h1 class="h3 mb-0 text-gray-800">Distribusi Data Pengguna</h1>
            <ol class="breadcrumb">
			  <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">{{env('APP_NAME')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page"><a href="{{url('distribution_of_user')}}">Distribusi Data Pengguna</a></li>
			  <li class="breadcrumb-item active" aria-current="page"><?= $data_provinsi ?></li>
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
            <!-- Row -->
			<div class="row">
				<!-- Datatables -->
				<div class="col-lg-12">
				  <div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
					  <h6 class="m-0 font-weight-bold text-primary">Data Pengguna</h6>
					</div>
					<div class="table-responsive p-3">
				  <table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
                    <thead class="thead-light">
					<tr>
					  <th>No.</th>
					  <th>Username</th>
					  <th>Role</th>
					  <th>Nama</th>
					  <th>Email</th>
					  <th>No. Handphone</th>
					</tr>
					</thead>
					<tbody>
					<?php $i=0; ?>
					<?php foreach ($ms_user as $ou){?>
						<tr>
							<td>
								<?php $i++; ?>
								<?php echo $i ?>
							</td>
							<td>
								<?php echo $ou->user_username ?>
							</td>
							<td>
								<?php echo $ou->user_role ?>
							</td>
							<td>
								<?php echo $ou->user_name ?>
							</td>
							<td>
								<?php echo $ou->user_email ?>
							</td>
							<td>
								<?php echo $ou->user_phone ?>
							</td>
						</tr>
					<?php } ?>
					</tbody>
				  </table>
				</div>
              </div>
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