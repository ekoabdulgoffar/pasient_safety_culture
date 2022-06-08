@extends('dist.layout') 

@section('title')
    PSC | Home
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Video Edukasi</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="user-dashboard">{{env('APP_NAME')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><a href="user-dashboard">Home</a></li>
	<li class="breadcrumb-item active" aria-current="page">Video</li>
  </ol>
</div>
@endsection 

@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12 mb-md"> 
				<iframe id="iframe_video" src="<?= $_GET['link'] ?>" width="100%" height="550px" class="iframe" allow="autoplay; encrypted-media" allowfullscreen></iframe>
			 </div>   
		</div>
	</div>
 </div>
 <br>
@endsection