		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
			  <div class="copyright text-center my-auto">
				<span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - {{env('APP_NAME')}} </span>
			  </div>
			</div>
		  </footer>
		
		<!-- Change password user -->	
		<div class="modal fade" id="modal-change-password">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			  <h4 class="modal-title">Ubah Kata Sandi</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<!-- form start -->
					<form role="form" action="{{ url('/user_update_password') }}" method="post">
					<div class="form-group">
					  <label for="password_old">Kata Sandi Lama</label>
					  {{ csrf_field() }}
					  <input type="password" class="form-control" id="password_old" name="password_old" placeholder="" required>
					</div>
					<div class="form-group">
					  <label for="password_new">Kata Sandi Baru</label>
					  <input type="password" class="form-control" id="password_new" name="password_new" placeholder="" required>
					</div>
					<div class="form-group">
					  <label for="password_confirm">Konfirmasi Kata Sandi</label>
					  <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="" required>
					  <span id="password_notif" style="color: red; display: inline;"></span>
					</div>
					  <!-- /.box-body -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary pull-right">Simpan</button>
			  </div>
					</form>
			  </div>
			</div>
			<!-- /.modal-content -->
		  </div>
		  <!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
	<!-- End Change password user-->