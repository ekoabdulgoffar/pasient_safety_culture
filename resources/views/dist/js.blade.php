	<script src="{{ asset('assets-ruang-admin/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('assets-ruang-admin/vendor/select2/dist/js/select2.min.js') }}"></script>
	<!-- Datatables -->
	<script src="{{ asset('assets-ruang-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/js/ruang-admin.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/buttons.print.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/jszip.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/pdfmake.min.js') }}"></script>
	<script src="{{ asset('assets-ruang-admin/vendor/export_datatables/vfs_fonts.js') }}"></script>
	<!-- ChartJS -->
	<script src="{{ asset('assets-ruang-admin/vendor/chart.js/Chart.min.js') }}"></script>
	
	  <!-- Page level custom scripts -->
	<script>
		$(document).ready(function () {
		  $('#dataTable').DataTable(); // ID From dataTable 
		  $('#dataTableHover').DataTable({
			  fixedColumns: true,
			  dom: 'Bfrtip',
			  buttons: [
					'copy', 'csv', 'excel', 'pdf', 'print'
			  ]
		  }); // ID From dataTable with Hover
		  
		  // Select2 Single  with Placeholder
		  $('.select2-single-placeholder').select2({
			placeholder: "-- Select One --",
			allowClear: true
		  });   
		});
	</script>
	
	<script>
		$(document).ready(function(){
		  $("#password_new").on( "keyup", function() {
				var password_new = $("#password_new").val();
				var password_confirm = $("#password_confirm").val();
				if (password_new == password_confirm) {
					$("#password_notif").html("");
				} else {
					$("#password_notif").html("New password and password confirmation incorrect.");
				}
		  });
		  $("#password_confirm").on( "keyup", function() {
				var password_new = $("#password_new").val();
				var password_confirm = $("#password_confirm").val();
				if (password_new == password_confirm) {
					$("#password_notif").html("");
				} else {
					$("#password_notif").html("New password and password confirmation incorrect.");
				}
		  });
		});
		
		
	  function hanyaAngka(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57 && charCode != 8))
            {
                return false;
            }
            else
            {
                return true;    
            }
        
        }
        function hanyaHuruf(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if ((charCode > 95 && charCode < 123)||(charCode > 64 && charCode < 91)||charCode==32 || charCode==8)
            {
                return true;
            }
            else
            {
                return false;   
            }
        }
	</script>