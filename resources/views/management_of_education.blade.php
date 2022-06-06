<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="{{ asset('assets-ruang-admin/img/pdgi.png') }}" rel="icon" />
    <title>{{env('APP_NAME')}} | Kelola FIle Edukasi</title>
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
              <h1 class="h3 mb-0 text-gray-800">Kelola File Edukasi</h1>
              <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">{{env('APP_NAME')}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kelola File Edukasi</li>
              </ol>
            </div>
            <!-- Content Body -->
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
						<i class="fa fa-plus"></i> Tambah
			</button>
			<br/><br/>
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
					  <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
					</div>
					<div class="table-responsive p-3">
					  <table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
						<thead class="thead-light">
						<tr>
						  <th style="text-align: center;">No.</th>
						  <th style="text-align: center;">Category of File</th>
						  <th style="text-align: center;">Description of PDF File</th>
						  <th style="text-align: center;">Link of PDF File</th>
						  <th style="text-align: center;">Description of Video File</th>
						  <th style="text-align: center;">Link of Video File</th>
						  <th style="text-align: center;">Action</th>
						</tr>
						</thead>
						<tbody>
						<?php $i=0; ?>
						<?php foreach ($ms_file_edukasi as $ou){?>
											<tr>
												<td>
													<?php $i++; ?>
													<?php echo $i ?>
												</td>
												<td>
													<?php echo $ou->edu_category ?>
												</td>
												<td>
													<?php echo $ou->edu_desk_pdf ?>
												</td>
												<td style="text-align: center">
													<a href="#" onclick="copyLink('<?php echo $ou->edu_file_pdf ?>')">
														<i class="fa fa-copy"></i>
													</a>
												</td>
												<td>
													<?php echo $ou->edu_desk_video ?>
												</td>
												<td style="text-align: center">
													<a href="#" onclick="copyLink('<?php echo $ou->edu_file_video ?>')">
														<i class="fa fa-copy"></i>
													</a>
												</td>
												<td>
													<a href="#" onclick="preview_edit('<?php echo $ou->edu_id ?>','<?php echo $ou->edu_desk_pdf ?>','<?php echo $ou->edu_file_pdf ?>','<?php echo $ou->edu_desk_video ?>','<?php echo $ou->edu_file_video ?>','<?php echo $ou->edu_category ?>'
													)" 
														data-toggle="modal" data-target="#modal-edit">
														<i class="fa fa-edit" title="Update"></i>
													</a> 
													| 
													<a href="#" onclick="preview_delete('<?php echo $ou->edu_id ?>')" 
														data-toggle="modal" data-target="#modal-delete">
														<i class="fa fa-trash" title="Delete"></i>
													</a> 
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
	
	<!-- Tambah Master Edukasi -->	
		<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Add Education File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_education/education_insert') }}" method="post">
					  <div class="box-body">
					  {{ csrf_field() }}
						<div class="form-group">
						  <label for="edu_desk_pdf">Description of PDF File</label>
						  <input type="text" class="form-control" id="edu_desk_pdf" name="edu_desk_pdf" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="edu_file_pdf">Link of PDF File</label>
						  <input type="text" class="form-control" id="edu_file_pdf" name="edu_file_pdf" placeholder="Example: https://link-pdf.com" required>
						</div>
						<div class="form-group">
						  <label for="edu_desk_video">Description of Video File</label>
						  <input type="text" class="form-control" id="edu_desk_video" name="edu_desk_video" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="edu_file_video">Link of Video File</label>
						  <input type="text" class="form-control" id="edu_file_video" name="edu_file_video" placeholder="Example: https://link-video.com" required>
						</div>
						<div class="form-group">
						  <label for="edu_category">Category File Education</label>
						  <select name="edu_category" id="edu_category" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="Introduction">Introduction</option>
								<option value="Evaluation">Evaluation</option>
							</select>
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
	<!-- ./ Tambah Master Edukasi -->
	
	<!-- Edit Master Edukasi -->	
		<div class="modal fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Edit Education File</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_education/education_update') }}" method="post">
					  <div class="box-body">
					  {{ csrf_field() }}
						<div class="form-group">
						  <label for="edu_desk_pdf_update">Description of PDF File</label>
						  <input type="text" class="form-control" id="edu_desk_pdf_update" name="edu_desk_pdf_update" placeholder="" required>
						  <input type="hidden" class="form-control" id="id_update" name="id_update">
						</div>
						<div class="form-group">
						  <label for="edu_file_pdf_update">Link of PDF File</label>
						  <input type="text" class="form-control" id="edu_file_pdf_update" name="edu_file_pdf_update" placeholder="Example: https://link-pdf.com" required>
						</div>
						<div class="form-group">
						  <label for="edu_desk_video_update">Description of Video File</label>
						  <input type="text" class="form-control" id="edu_desk_video_update" name="edu_desk_video_update" placeholder="" required>
						</div>
						<div class="form-group">
						  <label for="edu_file_video_update">Link of Video File</label>
						  <input type="text" class="form-control" id="edu_file_video_update" name="edu_file_video_update" placeholder="Example: https://link-video.com" required>
						</div>
						<div class="form-group">
						  <label for="edu_category_update">Category File Education</label>
						  <select name="edu_category_update" id="edu_category_update" 
							class="form-control" style="width:100%;" required>
								<option value="">--Select One--</option>
								<option value="Introduction">Introduction</option>
								<option value="Evaluation">Evaluation</option>
							</select>
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
	<!-- ./ Edit Master Edukasi -->
	
	<!-- Delete file edukasi -->	
		<div class="modal fade" id="modal-delete">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
				<h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              </div>
              <div class="modal-body">
			  Are you sure to delete this data?
                <!-- form start -->
					<form role="form" action="{{ url('/management_of_education/education_delete') }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" class="form-control" id="id_delete" name="id_delete">
					  
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
	<!-- .End Delete file edukasi-->
	
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
    @include('dist.js')
	 <script>
		function preview_edit(id_update,edu_desk_pdf,edu_file_pdf,edu_desk_video,edu_file_video,edu_category){
		  //alert(id);
		  document.getElementById("id_update").value = id_update;
		  document.getElementById("edu_desk_pdf_update").value = edu_desk_pdf;
		  document.getElementById("edu_file_pdf_update").value = edu_file_pdf;
		  document.getElementById("edu_desk_video_update").value = edu_desk_video;
		  document.getElementById("edu_file_video_update").value = edu_file_video;
		  document.getElementById("edu_category_update").value = edu_category;
	  }
	  function preview_delete(id){
			  //alert(id);
			  document.getElementById("id_delete").value = id;
		}
		
	   function copyLink(text) {
		  navigator.clipboard.writeText(text);
		  /* Alert the copied text */
		  alert("Copied the text: " + text);
		}

  </script>
  </body>
</html>
