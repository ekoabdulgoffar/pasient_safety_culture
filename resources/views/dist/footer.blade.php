		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
			  <div class="copyright text-center my-auto">
				<span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - Sistem Informasi Pasient Safety Culture </span>
			  </div>
			</div>
		  </footer>
		
		<!-- Change password user -->	
		<div class="modal fade" id="modal-change-password">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
			  <h4 class="modal-title">Change Password</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
			  </div>
			  <div class="modal-body">
				<!-- form start -->
					<form role="form" action="{{ url('/management_of_user/user_update_password') }}" method="post">
					<div class="form-group">
					  <label for="password_old">Old Password</label>
					  {{ csrf_field() }}
					  <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Enter old password" required>
					</div>
					<div class="form-group">
					  <label for="password_new">New Password</label>
					  <input type="password" class="form-control" id="password_new" name="password_new" placeholder="Enter new password" required>
					</div>
					<div class="form-group">
					  <label for="password_confirm">Confirm Passowrd</label>
					  <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Enter confirm password" required>
					  <span id="password_notif" style="color: red; display: inline;"></span>
					</div>
					  <!-- /.box-body -->
			  <div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-primary pull-right">Save</button>
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