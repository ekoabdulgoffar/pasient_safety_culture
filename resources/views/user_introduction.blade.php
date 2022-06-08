@extends('dist.layout') 

@section('title')
    PSC | Home
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Introduction</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="user-dashboard">{{env('APP_NAME')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Introduction</li>
  </ol>
</div>
@endsection 

@section('content')
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
<br>
@endsection