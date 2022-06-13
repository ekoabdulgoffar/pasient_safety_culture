<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets/image/logo-safe_dental.jpeg') }}" rel="icon" />
  <title>{{env('APP_NAME')}} | Users DIstribution</title>
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
              <li class="breadcrumb-item active" aria-current="page">Distribusi Data Pengguna</li>
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
					  <th class="text-center">No.</th>
					  <th class="text-center">Provinsi</th>
					  <th class="text-center">Jumlah</th>
					  <th class="text-center">Aksi</th>
					</tr>
					</thead>
					<tbody>
					<?php $i=0; ?>
					<?php foreach ($ms_user as $ou){?>
						@if ($ou->user_provinsi != '-')
						<tr>
							<td class="text-center">
								<?php $i++; ?>
								<?php echo $i ?>
							</td>
							<td>
								<?php echo $ou->user_provinsi ?>
							</td>
							<td class="text-right">
								<?php echo $ou->user_total ?>
							</td>
							<td class="text-center">	
								<a href="{{ url('/distribution_of_user/detail/'.myencrypt($ou->user_provinsi,'Pasientsafetyculture@2022')) }}">
									<i class="fa fa-bars" title="Periode"></i>
								</a> 
							</td>
						</tr>
						@endif
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
  
  <!-- Tambah Master User -->	
		<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_user/user_insert') }}" method="post">
					  <div class="box-body">
					  {{ csrf_field() }}
						<div class="form-group">
						  <label for="user_username">Username</label>
						  <input type="text" class="form-control" id="user_username" name="user_username" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="user_name">Name</label>
						  <input type="text" class="form-control" id="user_name" name="user_name" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="user_date_of_born">Date of Born (Optional)</label>
						  <input type="date" class="form-control" id="user_tanggal_lahir" name="user_tanggal_lahir" placeholder="">
						</div>
						<div class="form-group">
							<label for="user_jenis_kelamin">Gender</label>
							<table>
								<tr>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_male" name="user_jenis_kelamin" value="1">
										  <label class="custom-control-label" for="user_male">Male</label>
										</div>
									</td>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_female" name="user_jenis_kelamin" value="0">
										  <label class="custom-control-label" for="user_female">Female</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<label for="user_address">Address (Optional)</label>
							<textarea class="form-control" id="user_alamat" name="user_alamat" cols="40" rows="5"></textarea>
						</div>
						<div class="form-group">
						  <label for="user_email">Email</label>
						  <input type="email" class="form-control" id="user_email" name="user_email" placeholder="Example: a@b.c" required>
						</div>
						<div class="form-group">
						  <label for="user_phone">Phone</label>
						  <input type="text" class="form-control" id="user_phone" name="user_phone" maxlength="13"
						  placeholder="Enter Phone" onkeypress="return hanyaAngka(event)" required>
						</div>
						<div class="form-group">
						  <label for="user_role">Role</label>
						  <select name="user_role" id="user_role" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="Admin">Admin</option>
								<option value="User">User</option>
								<option value="Dokter Gigi">Dokter Gigi</option>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_pendidikan_terakhir">Last Education</label>
						  <select name="user_pendidikan_terakhir" id="user_pendidikan_terakhir" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="D4">D4</option>
								<option value="S1">S1</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_provinsi">Province</label>
						  <select name="user_provinsi" id="user_provinsi" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<?php foreach ($data_provinsi as $row) { ?>
									<option value="<?= $row ?>"><?= $row ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_npa">NPA</label>
						  <input type="text" class="form-control" id="user_npa" name="user_npa"
						  placeholder="">
						</div>
						<div class="form-group">
						  <label for="user_phone">Cabang Keanggotaan (Optional)</label>
						  <input type="text" class="form-control" id="user_cabang_keanggotaan" name="user_cabang_keanggotaan"
						  placeholder="">
						</div>
						<div class="form-group">
						  <label for="user_phone">Wilayah Keanggotaan (Optional)</label>
						  <input type="text" class="form-control" id="user_wilayah_keanggotaan" name="user_wilayah_keanggotaan"
						  placeholder="">
						</div>
					  </div>
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
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
  
  <!-- Master User Edit -->	
		<div class="modal fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Edit User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_user/user_update') }}" method="post">
					  <div class="box-body">
					  {{ csrf_field() }}
						<div class="form-group">
						  <label for="user_username_update">Username</label>
						  <input type="text" class="form-control" id="user_username_update" name="user_username_update" placeholder="" required readonly>
						  <input type="hidden" class="form-control" id="id_update" name="id_update">
						</div>
						<div class="form-group">
						  <label for="user_name_update">Name</label>
						  <input type="text" class="form-control" id="user_name_update" name="user_name_update" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="user_tanggal_lahir_update">Date of Born (Optional)</label>
						  <input type="date" class="form-control" id="user_tanggal_lahir_update" name="user_tanggal_lahir_update" placeholder="">
						</div>
						<div class="form-group">
							<label for="user_gender_update">Gender</label>
							<table>
								<tr>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_male_update" name="user_jenis_kelamin_update" value="1">
										  <label class="custom-control-label" for="user_male_update">Male</label>
										</div>
									</td>
									<td>
										<div class="custom-control custom-radio custom-control-inline">
										  <input type="radio" class="custom-control-input" id="user_female_update" name="user_jenis_kelamin_update" value="0">
										  <label class="custom-control-label" for="user_female_update">Female</label>
										</div>
									</td>
								</tr>
							</table>
						</div>
						<div class="form-group">
							<label for="user_alamat_update">Address (Optional)</label>
							<textarea class="form-control" id="user_alamat_update" name="user_alamat_update" cols="40" rows="5"></textarea>
						</div>
						<div class="form-group">
						  <label for="user_email_update">Email</label>
						  <input type="email" class="form-control" id="user_email_update" name="user_email_update" placeholder="Enter Email" required>
						</div>
						<div class="form-group">
						  <label for="user_phone_update">Phone</label>
						  <input type="text" class="form-control" id="user_phone_update" name="user_phone_update" maxlength="13"
						  placeholder="Enter Phone" onkeypress="return hanyaAngka(event)" required>
						</div>
						<div class="form-group">
						  <label for="user_role_update">Role</label>
						  <select name="user_role_update" id="user_role_update" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="Admin">Admin</option>
								<option value="User">User</option>
								<option value="Dokter Gigi">Dokter Gigi</option>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_pendidikan_terakhir_update">Last Education</label>
						  <select name="user_pendidikan_terakhir_update" id="user_pendidikan_terakhir_update" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="D1">D1</option>
								<option value="D2">D2</option>
								<option value="D3">D3</option>
								<option value="D4">D4</option>
								<option value="S1">S1</option>
								<option value="S2">S2</option>
								<option value="S3">S3</option>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_provinsi_update">Province</label>
						  <select name="user_provinsi_update" id="user_provinsi_update" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<?php foreach ($data_provinsi as $row) { ?>
									<option value="<?= $row ?>"><?= $row ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
						  <label for="user_npa_update">NPA</label>
						  <input type="text" class="form-control" id="user_npa_update" name="user_npa_update"
						  placeholder="">
						</div>
						<div class="form-group">
						  <label for="user_phone">Cabang Keanggotaan (Optional)</label>
						  <input type="text" class="form-control" id="user_cabang_keanggotaan_update" name="user_cabang_keanggotaan_update"
						  placeholder="">
						</div>
						<div class="form-group">
						  <label for="user_phone">Wilayah Keanggotaan (Optional)</label>
						  <input type="text" class="form-control" id="user_wilayah_keanggotaan_update" name="user_wilayah_keanggotaan_update"
						  placeholder="">
						</div>
					  </div>
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
                <button type="submit" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
              </div>
					</form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- ./ Master User Edit-->
  
  <!-- Active/not active master user -->	
		<div class="modal fade" id="modal-default-edit-status">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Set Active or Not Active</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
			  Are you sure to update this data?
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_user/user_update_status') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" class="form-control" id="id_update_status" name="id_update_status">
					<input type="hidden" class="form-control" id="status_update" name="status_update">
					  
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">No</button>
                <button type="submit" class="btn btn-primary pull-right">Yes</button>
              </div>
					</form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- ./Active/not active master user-->
  
	<!-- reset password user -->	
		<div class="modal fade" id="modal-reset-password">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			  <h4 class="modal-title">Reset Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<!-- form start -->
					<form role="form" action="{{ url('/management_of_user/reset_password') }}" method="post">
					<div class="form-group">
					  <label for="password_new">New Password</label>
					  {{ csrf_field() }}
					  <input type="hidden" class="form-control" id="user_id_reset" name="user_id_reset">
					  <input type="password" class="form-control" id="password_new_reset" name="password_new_reset" placeholder="Enter new password" required>
					</div>
					<div class="form-group">
					  <label for="password_confirm_reset">Confirm Password</label>
					  <input type="password" class="form-control" id="password_confirm_reset" name="password_confirm_reset" placeholder="Enter confirm password" required>
					  <span id="password_notif_reset" style="color: red; display: inline;"></span>
					</div>
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary pull-right">Save</button>
			  </div>
					</form>
			</div>
			<!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<!-- End reset password user-->
  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('dist.js')
  <script>
		function preview_update_status(id,status){
		  //alert(id);
		  document.getElementById("id_update_status").value = id;
		  document.getElementById("status_update").value = status;
		}
		  
		function preview_reset_password(id){
			  //alert(id);
			  document.getElementById("user_id_reset").value = id;
		}
		
		function preview_edit(id_update,user_username_update,user_name_update,user_tanggal_lahir_update,user_jenis_kelamin_update,user_alamat_update,user_email_update,user_phone_update,user_role_update,user_pendidikan_terakhir_update,user_provinsi_update,user_npa_update,user_cabang_keanggotaan_update,user_wilayah_keanggotaan_update){
		  //alert(id);
		  document.getElementById("id_update").value = id_update;
		  document.getElementById("user_username_update").value = user_username_update;
		  document.getElementById("user_name_update").value = user_name_update;
		  document.getElementById("user_tanggal_lahir_update").value = user_tanggal_lahir_update;
		  if(user_jenis_kelamin_update=='1'){
			   $("#user_male_update").prop("checked", true);
		  }else{
			   $("#user_female_update").prop("checked", true);
		  }
		  document.getElementById("user_alamat_update").value = user_alamat_update;
		  document.getElementById("user_email_update").value = user_email_update;
		  document.getElementById("user_phone_update").value = user_phone_update;
		  document.getElementById("user_role_update").value = user_role_update;
		  document.getElementById("user_pendidikan_terakhir_update").value = user_pendidikan_terakhir_update;
		  document.getElementById("user_provinsi_update").value = user_provinsi_update;
		  document.getElementById("user_npa_update").value = user_npa_update;
		  document.getElementById("user_cabang_keanggotaan_update").value = user_cabang_keanggotaan_update;
		  document.getElementById("user_wilayah_keanggotaan_update").value = user_wilayah_keanggotaan_update;
	  }
  </script>
</body>

</html>