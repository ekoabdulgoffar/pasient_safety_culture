  <link href="{{ asset('assets-ruang-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets-ruang-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets-ruang-admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets-ruang-admin/vendor/export_datatables/buttons.dataTables.min.css') }}" rel="stylesheet">
  <!-- Select2 -->
  <link href="{{ asset('assets-ruang-admin/vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('assets-ruang-admin/css/ruang-admin.min.css') }}" rel="stylesheet">
  <style>
	
	
	#header-mobile {
		display: none;
	}
	
	@media only screen and (max-width: 600px) {
	  #header-dekstop {
		display: none;
	  }
	  
	  #header-mobile {
		display: block;
	  }
	}
	
	.avatar {
	  vertical-align: middle;
	  width: 40px;
	  height: 40px;
	  border-radius: 50%;
	  border: 1px solid #fff;
	}
	
	#loading {
	  position: fixed;
	  display: block;
	  width: 100%;
	  height: 100%;
	  top: 0;
	  left: 0;
	  text-align: center;
	  opacity: 0.7;
	  background-color: #fff;
	  z-index: 99;
	}

	#loading-image {
	  margin-top: 150px;
	  display: block;
	  margin-left: auto;
	  margin-right: auto;
	  z-index: 100;
	  width: 100px;
	  height: 100px;
	}
  
  </style>
  