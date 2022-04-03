<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon">
  <title>PSC | Login</title>
  <link href="{{ asset('assets-ruang-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets-ruang-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets-ruang-admin/css/ruang-admin.min.css') }}" rel="stylesheet">
  <style>
		body, html {
		  height: 100%;
		}

		.bg { 
		  /* The image used */
		  background-image: url("{{ asset('assets-ruang-admin/img/bg-kedokteran.jpg') }}");

		  /* Full height */
		  height: 100%; 

		  /* Center and scale the image nicely */
		  background-position: center;
		  background-repeat: no-repeat;
		  background-size: cover;
		  background-color: #16170A;
		}

	</style>
</head>

<body class="bg">
  <!-- Login Content -->
  <div class="container-login">
	<br/><br/>
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4"><b>Login</b>
					<br><br/>
					<span>
						<b>Information System for Pasient Safety Culture</b>
					</span>
					<br/><br/>
					<!--<img src="{{ asset('assets-ruang-admin/img/pdgi.png') }}" alt="logo-drrc" style="width: 100px; height: auto;">-->
					</h1>
                  </div>
				  <?php if (isset($crud_result)) {
							if ($crud_result == 1) { ?>
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							  <span aria-hidden="true">&times;</span>
							</button>
							<h6><i class="fas fa-check"></i><b> Thank you!</b></h6>
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
                  <form class="user" action="{{ url('/login') }}" method="post" autocomplete="off">
					<?php if (isset($data['invalid_login'])) if ($data['invalid_login'] == 1) { ?>
						<center><p style="color: red;">Username and password incorrect</p></center>
					<?php } ?>
					  <div>
						{{ csrf_field() }}
                    <div class="form-group">
                      <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp"
                        placeholder="Masukan Username" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
                    </div>
                    <div class="form-group">
					  <button type="submit" class="btn  btn-primary btn-block">Login</button>
                    </div>
                  </form>
                  
                  <!--<div class="text-center">
					Don't have an account ? <a href="#" data-toggle="modal" data-target="#modal-default">Register</a>
                  </div>-->
                </div>
              </div>
            </div>
          </div>
		</div>
      </div>
    </div>
  </div>
  
  <!-- Tambah Master User -->	
		<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Register</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- form start -->
					<form role="form" action="#" method="post">
					  <div class="box-body">
					  {{ csrf_field() }}
						<div class="form-group">
						  <label for="user_username">Username</label>
						  <input type="text" class="form-control" id="user_username" name="user_username" placeholder="Enter username" required>
						</div>
						<div class="form-group">
						  <label for="user_name">Name</label>
						  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter name" required>
						</div>
						<div class="form-group">
						  <label for="user_company">Institution</label>
						  <input type="text" class="form-control" id="user_company" name="user_company" placeholder="Example: DRRC UI" required>
						</div>
						<div class="form-group">
						  <label for="user_date_of_born">Date of Born (Optional)</label>
						  <input type="date" class="form-control" id="user_date_of_born" name="user_date_of_born" placeholder="Enter your date of born">
						</div>
						<div class="form-group">
						  <label for="user_place_of_born">Place of Born (Optional)</label>
						  <input type="text" class="form-control" id="user_place_of_born" name="user_place_of_born" placeholder="Enter your place of born">
						</div>
						<div class="form-group">
							<label for="user_gender">Gender</label>
							<table>
								<tr>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_male" name="user_gender" value="1">
										  <label class="custom-control-label" for="user_male">Male</label>
										</div>
									</td>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_female" name="user_gender" value="0">
										  <label class="custom-control-label" for="user_female">Female</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<label for="user_address">Address (Optional)</label>
							<textarea class="form-control" id="user_address" name="user_address" cols="40" rows="5"></textarea>
						</div>
						<div class="form-group">
						  <label for="user_email">Email</label>
						  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Enter Email" required>
						</div>
						<div class="form-group">
						  <label for="user_phone">Phone</label>
						  <input type="text" class="form-control" id="user_phone" name="user_phone" maxlength="13"
						  placeholder="Enter Phone" onkeypress="return hanyaAngka(event)" required>
						</div>
					  </div>
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
					</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- ./ Tambah Master User -->
  
  <!-- Login Content -->
  <script src="{{ asset('assets-ruang-admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets-ruang-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets-ruang-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('assets-ruang-admin/js/ruang-admin.min.js') }}"></script>
</body>

</html>