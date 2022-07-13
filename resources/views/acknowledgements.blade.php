<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{ asset('assets/image/logo-safe_dental.jpeg') }}" rel="icon" />
  <title>{{env('APP_NAME')}} | Users DIstribution Detail</title>
  @include('dist.css')
  <style>
  .iframe{
      height: 480px;
    }
  @media (min-width: 1025px){
    .iframe{
      height: 600px;
    }
  }
</style>
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
            <h1 class="h3 mb-0 text-gray-800">Acknowledgements</h1>
            <ol class="breadcrumb">
			  <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">{{env('APP_NAME')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">Acknowledgements</li>
            </ol>
          </div>
		  <!-- Content Body -->
			
			<ul class="nav nav-tabs">
			  <li class="nav-item">
			  <a class="nav-link active" data-toggle="tab" href="#video">Video</a>
			  </li>
			  <li class="nav-item">
			  <a class="nav-link" data-toggle="tab" href="#pdf">PDF</a>
			  </li>
			</ul>

			<div class="tab-content">
			  <div id="video" class="tab-pane in active">
				<br>
				<h3><?= $title_video ?></h3>
				<p>
				<iframe src="<?= $link_video ?>" width="100%" class="iframe" allow="autoplay"></iframe>
				</p>
			  </div>
			  <div id="pdf" class="tab-pane fade">
				<br>
				<h3><?= $title_pdf ?></h3>
				<p>
				<iframe src="<?= $link_pdf ?>" width="100%" class="iframe" allow="autoplay"></iframe>
				</p>
			  </div>
			</div>
			
		   <!-- End Content Body -->
		</div>
    </div>
  </div>
  
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('dist.js')
 
</body>

</html>