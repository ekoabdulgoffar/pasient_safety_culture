<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon">
  <title>PSC | History Questionnaire</title>
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
            <h1 class="h3 mb-0 text-gray-800">History Questionnaire</h1>
            <ol class="breadcrumb">
			  <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
              <li class="breadcrumb-item active" aria-current="page">History Questionnaire</li>
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
					  <h6 class="m-0 font-weight-bold text-primary">Respondent Data</h6>
					  <!-- <button style="float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-legend">
						Legend
					  </button> -->
					</div>
					<div class="table-responsive p-3">
					  <table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
						<thead class="thead-light">
						<tr>
						  <?php 
							for ($i = 0; $i < count($table_history_header); $i++) {
								echo "<th>".$table_history_header[$i]."</th>";
							}
						  ?>
						  
						</tr>
						</thead>
						<tbody>
							<?php
								echo $table_history_isi_jawaban;
							?>
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
  
  <!-- Show Legend -->	
		<div class="modal fade" id="modal-legend">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Legend of Score</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
				
				<table class="table align-items-center table-flush table-hover nowrap">
					<tr>
						<th>No.</th>
						<th>Score</th>
						<th>Interpretation</th>
					</tr>
					<tr>
						<td>1</td>
						<td>SANGAT BERAT</td>
						<td style="text-align: center;">> 80%</td>
					</tr>
					<tr>
						<td>2</td>
						<td>BERAT</td>
						<td style="text-align: center;">61 - 80%</td>
					</tr>
					<tr>
						<td>3</td>
						<td>SEDANG</td>
						<td style="text-align: center;">41 - 60%</td>
					</tr>
					<tr>
						<td>4</td>
						<td>SANGAT BERAT</td>
						<td style="text-align: center;">21 - 40%</td>
					</tr>
					<tr>
						<td>5</td>
						<td>SANGAT BERAT</td>
						<td style="text-align: center;"> < 20% </td>
					</tr>
				<table>
                <!-- form start -->
					<form role="form" action="#" method="post">
					
					  <!-- /.box-body -->
			  </div>
			  <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
              </div>
					</form>
              
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
	<!-- End Show Legend -->
  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('dist.js')
</body>

</html>