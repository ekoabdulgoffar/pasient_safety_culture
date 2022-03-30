<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon" />
    <title>PSC | Profile</title>
    @include('dist.css')
  </head>

  <body id="page-top">
    <div id="wrapper">
      <!-- Sidebar -->
	  <?php if (session('user_role') == 'Admin') { ?>
      @include('dist.menu_admin')
	  <?php } else if (session('user_role') == 'User') { ?>
	  @include('dist.menu_user')
	  <?php }?>
      <!-- Sidebar -->
      <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
          <!-- TopBar -->
          @include('dist.header')
          <!-- Topbar -->

          <!-- Container Fluid-->
          <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Profile</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
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
					  <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
					</div>
					<div class="table-responsive p-3">
						<form role="form" action="{{ url('/page_profile/update') }}" method="post">
							{{ csrf_field() }}
							<?php foreach ($data_user_byID as $row) { ?>
							<div class="form-group">
							  <label for="user_username_update">Username</label>
							  <input type="text" class="form-control" id="user_username_update" name="user_username_update" placeholder="" required readonly value="<?= $row->user_username ?>">
							  <input type="hidden" class="form-control" id="id_update" name="id_update" value="<?= $row->user_id ?>">
							</div>
							<div class="form-group">
							  <label for="user_name_update">Name</label>
							  <input type="text" class="form-control" id="user_name_update" name="user_name_update" placeholder="" required value="<?= $row->user_name ?>">
							</div>
							<div class="form-group">
							  <label for="user_tanggal_lahir_update">Date of Born (Optional)</label>
							  <input type="date" class="form-control" id="user_tanggal_lahir_update" name="user_tanggal_lahir_update" placeholder="" value="<?= $row->user_tanggal_lahir ?>">
							</div>
							<div class="form-group">
								<label for="user_gender_update">Gender</label>
								<table>
									<tr>
										<td>
											<div class="custom-control custom-radio custom-control-inline">
											  <input type="radio" class="custom-control-input" id="user_male_update" name="user_jenis_kelamin_update" value="1" <?= $row->user_jenis_kelamin == 1 ? 'checked' : '' ?> >
											  <label class="custom-control-label" for="user_male_update">Male</label>
											</div>
										</td>
										<td>
											<div class="custom-control custom-radio custom-control-inline">
											  <input type="radio" class="custom-control-input" id="user_female_update" name="user_jenis_kelamin_update" value="0" <?= $row->user_jenis_kelamin == 0 ? 'checked' : '' ?> >
											  <label class="custom-control-label" for="user_female_update">Female</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div class="form-group">
								<label for="user_alamat_update">Address (Optional)</label>
								<textarea class="form-control" id="user_alamat_update" name="user_alamat_update" cols="40" rows="5"><?= $row->user_alamat ?></textarea>
							</div>
							<div class="form-group">
							  <label for="user_email_update">Email</label>
							  <input type="email" class="form-control" id="user_email_update" name="user_email_update" placeholder="Enter Email" required value="<?= $row->user_email ?>">
							</div>
							<div class="form-group">
							  <label for="user_phone_update">Phone</label>
							  <input type="text" class="form-control" id="user_phone_update" name="user_phone_update" maxlength="13"
							  placeholder="Enter Phone" onkeypress="return hanyaAngka(event)" required value="<?= $row->user_phone ?>">
							</div>
							<div class="form-group">
							  <label for="user_role_update">Role</label>
							  <select name="user_role_update" id="user_role_update" 
								class="form-control" style="width:100%;" required>
									<option value="null">--Select One--</option>
									<option value="Admin" <?= $row->user_role == 'Admin' ? 'selected' : '' ?>>Admin</option>
									<option value="User" <?= $row->user_role == 'User' ? 'selected' : '' ?>>User</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_pendidikan_terakhir_update">Last Education</label>
							  <select name="user_pendidikan_terakhir_update" id="user_pendidikan_terakhir_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="D1" <?= $row->user_pendidikan_terakhir == 'D1' ? 'selected' : '' ?>>D1</option>
									<option value="D2" <?= $row->user_pendidikan_terakhir == 'D2' ? 'selected' : '' ?>>D2</option>
									<option value="D3" <?= $row->user_pendidikan_terakhir == 'D3' ? 'selected' : '' ?>>D3</option>
									<option value="D4" <?= $row->user_pendidikan_terakhir == 'D4' ? 'selected' : '' ?>>D4</option>
									<option value="S1" <?= $row->user_pendidikan_terakhir == 'S1' ? 'selected' : '' ?>>S1</option>
									<option value="S2" <?= $row->user_pendidikan_terakhir == 'S2' ? 'selected' : '' ?>>S2</option>
									<option value="S3" <?= $row->user_pendidikan_terakhir == 'S3' ? 'selected' : '' ?>>S3</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_provinsi_update">Province</label>
							  <select name="user_provinsi_update" id="user_provinsi_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<?php foreach ($data_provinsi as $row_provinsi) { ?>
										<option value="<?= $row_provinsi ?>" <?= $row->user_provinsi == $row_provinsi ? 'selected' : '' ?>><?= $row_provinsi ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_npa_update">NPA</label>
							  <input type="text" class="form-control" id="user_npa_update" name="user_npa_update"
							  placeholder="" value="<?= $row->user_npa ?>">
							</div>
							<div class="form-group">
							  <label for="user_cabang_keanggotaan_update">Cabang Keanggotaan (Optional)</label>
							  <input type="text" class="form-control" id="user_cabang_keanggotaan_update" name="user_cabang_keanggotaan_update"
							  placeholder="" value="<?= $row->user_cabang_keanggotaan ?>">
							</div>
							<div class="form-group">
							  <label for="user_phone">Wilayah Keanggotaan (Optional)</label>
							  <input type="text" class="form-control" id="user_wilayah_keanggotaan_update" name="user_wilayah_keanggotaan_update"
							  placeholder=""  value="<?= $row->user_wilayah_keanggotaan ?>">
							</div>
							<br>
							
							<button type="submit" class="btn btn-primary">Edit</button>
							
							<?php } ?>
						</form>
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
