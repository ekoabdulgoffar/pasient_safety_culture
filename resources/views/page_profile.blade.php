<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('assets/image/logo-safe_dental.jpeg') }}" rel="icon" />
    <title>{{env('APP_NAME')}} | Profil</title>
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
              <h1 class="h3 mb-0 text-gray-800">Profil</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">{{env('APP_NAME')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
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
					  <h6 class="m-0 font-weight-bold text-primary"></h6>
					</div>
					<div class="table-responsive p-3">
						<form role="form" action="{{ url('/page_profile/update') }}" method="post">
							{{ csrf_field() }}
							<?php foreach ($data_user_byID as $row) { ?>
							
								<h4><u>Personal</u></h4>
							<br>
							<div class="form-group">
							  <label for="user_username_update">Username</label>
							  <input type="text" class="form-control" id="user_username_update" name="user_username_update" placeholder="" required readonly value="<?= $row->user_username ?>">
							  <input type="hidden" class="form-control" id="id_update" name="id_update" value="<?= $row->user_id ?>">
							</div>
							<div class="form-group">
							  <label for="user_name_update">Nama</label>
							  <input type="text" class="form-control" id="user_name_update" name="user_name_update" placeholder="" required value="<?= $row->user_name ?>">
							</div>
							<div class="form-group">
							  <label for="user_tanggal_lahir_update">Tanggal Lahir (Optional)</label>
							  <input type="date" class="form-control" id="user_tanggal_lahir_update" name="user_tanggal_lahir_update" placeholder="" value="<?= $row->user_tanggal_lahir ?>">
							</div>
							<div class="form-group">
								<label for="user_gender_update">Jenis Kelamin</label>
								<table>
									<tr>
										<td>
											<div class="custom-control custom-radio custom-control-inline">
											  <input type="radio" class="custom-control-input" id="user_male_update" name="user_jenis_kelamin_update" value="1" <?= $row->user_jenis_kelamin == 1 ? 'checked' : '' ?> >
											  <label class="custom-control-label" for="user_male_update">Laki-laki</label>
											</div>
										</td>
										<td>
											<div class="custom-control custom-radio custom-control-inline">
											  <input type="radio" class="custom-control-input" id="user_female_update" name="user_jenis_kelamin_update" value="0" <?= $row->user_jenis_kelamin == 0 ? 'checked' : '' ?> >
											  <label class="custom-control-label" for="user_female_update">Perempuan</label>
											</div>
										</td>
									</tr>
								</table>
							</div>
							<div class="form-group">
								<label for="user_alamat_update">Alamat (Optional)</label>
								<textarea class="form-control" id="user_alamat_update" name="user_alamat_update" cols="40" rows="5"><?= $row->user_alamat ?></textarea>
							</div>
							<div class="form-group">
							  <label for="user_email_update">Email</label>
							  <input type="email" class="form-control" id="user_email_update" name="user_email_update" placeholder="Enter Email" required value="<?= $row->user_email ?>">
							</div>
							<div class="form-group">
							  <label for="user_phone_update">No. Handphone</label>
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
							  <label for="user_pendidikan_terakhir_update">Pendidikan Terakhir</label>
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
							  <label for="user_provinsi_update">Provinsi</label>
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
								<h4><u>Detail Profil</u></h4>
							<br>
							
							<div class="form-group">
							  <label for="user_p1_update">Tempat bekerja atau praktik</label>
							  <select name="user_p1_update" id="user_p1_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Fasilitas Kesehatan Primer" <?= $row->user_p1 == 'Fasilitas Kesehatan Primer' ? 'selected' : '' ?>>
										Fasilitas Kesehatan Primer
									</option>
									<option value="Fasilitas Kesehatan Sekunder" <?= $row->user_p1 == 'Fasilitas Kesehatan Sekunder' ? 'selected' : '' ?>>
										Fasilitas Kesehatan Sekunder
									</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_p2_update">Saya berpraktik di (Puskesmas/Klinik/Rumah Sakit Umum/Rumah Sakit Swasta/Dsb.)</label>
							  <select name="user_p2_update" id="user_p2_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Praktik Pribadi" <?= $row->user_p2 == 'Praktik Pribadi' ? 'selected' : '' ?>>
										Praktik Pribadi
									</option>
									<option value="Klinik Swasta/Bersama" <?= $row->user_p2 == 'Klinik Swasta/Bersama' ? 'selected' : '' ?>>
										Klinik Swasta/Bersama
									</option>
									<option value="Klinik Pratama" <?= $row->user_p2 == 'Klinik Pratama' ? 'selected' : '' ?>>
										Klinik Pratama
									</option>
									<option value="Puskesmas" <?= $row->user_p2 == 'Puskesmas' ? 'selected' : '' ?>>
										Puskesmas
									</option>
									<option value="Rumah Sakit Pemerintah" <?= $row->user_p2 == 'Rumah Sakit Pemerintah' ? 'selected' : '' ?>>
										Rumah Sakit Pemerintah
									</option>
									<option value="Rumah Sakit Swasta" <?= $row->user_p2 == 'Rumah Sakit Swasta' ? 'selected' : '' ?>>
										Rumah Sakit Swasta
									</option>
									<option value="Rumah Sakit Khusus lain (Mata,Ibu Anak,Jiwa,dll)" <?= $row->user_p2 == 'Rumah Sakit Khusus lain (Mata,Ibu Anak,Jiwa,dll)' ? 'selected' : '' ?>>
										Rumah Sakit Khusus lain (Mata,Ibu Anak,Jiwa,dll)
									</option>
									<option value="Rumah Sakit Khusus Gigi & Mulut" <?= $row->user_p2 == 'Rumah Sakit Khusus Gigi & Mulut' ? 'selected' : '' ?>>
										Rumah Sakit Khusus Gigi & Mulut
									</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_p3_update">Area tempat praktik</label>
							  <select name="user_p3_update" id="user_p3_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Perkotaan" <?= $row->user_p3 == 'Perkotaan' ? 'selected' : '' ?>>
										Perkotaan
									</option>
									<option value="Rural Area" <?= $row->user_p3 == 'Rural Area' ? 'selected' : '' ?>>
										Rural Area (Bukan Perkotaan)
									</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_p4_update">Jumlah pasien yang saya kerjakan per hari</label>
							  <input type="text" class="form-control" id="user_p4_update" name="user_p4_update"
							  placeholder="" value="<?= $row->user_p4 ?>">
							</div>
							<div class="form-group">
							  <label for="user_p5_update">Hingga saat ini telah berpraktik selama</label>
							  <input type="text" class="form-control" id="user_p5_update" name="user_p5_update"
							  placeholder="" value="<?= $row->user_p5 ?>">
							</div>
							<div class="form-group">
							  <label for="user_p6_update">Dalam 5 (lima) tahun terakhir pernahkah anda mengikuti pelatihan/seminar tentang keselamatan pasien ?</label>
							  <select name="user_p6_update" id="user_p6_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Pernah" <?= $row->user_p6 == 'Pernah' ? 'selected' : '' ?>>
										Pernah
									</option>
									<option value="Tidak Pernah" <?= $row->user_p6 == 'Tidak Pernah' ? 'selected' : '' ?>>
										Tidak Pernah
									</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_p7_update">Anda memiliki STR yang masih berlaku</label>
							  <select name="user_p7_update" id="user_p7_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Ya" <?= $row->user_p7 == 'Ya' ? 'selected' : '' ?>>
										Ya
									</option>
									<option value="Tidak" <?= $row->user_p7 == 'Tidak' ? 'selected' : '' ?>>
										Tidak
									</option>
								</select>
							</div>
							<div class="form-group">
							  <label for="user_p8_update">Anda memiliki SIP yang masih berlaku</label>
							  <select name="user_p8_update" id="user_p8_update" 
								class="form-control" style="width:100%;" required>
									<option value="">--Select One--</option>
									<option value="Ya" <?= $row->user_p8 == 'Ya' ? 'selected' : '' ?>>
										Ya
									</option>
									<option value="Tidak" <?= $row->user_p8 == 'Tidak' ? 'selected' : '' ?>>
										Tidak
									</option>
								</select>
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
