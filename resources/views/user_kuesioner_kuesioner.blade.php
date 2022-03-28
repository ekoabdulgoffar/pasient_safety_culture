@extends('dist.layout') 

@section('title')
PSC 2022 | Riwayat Kuesioner
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Riwayat Kuesioner</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">PSC</a></li>
    <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li> --}}
  </ol>
</div>
@endsection 

@section('content')
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" href="user-kuesioner">Riwayat Pengisian Saya</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="#">Daftar Kuesioner</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <div class="table-responsive p-3 table-striped">
			<table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
			  <thead class="">
				<th>No</th>
				<th>Kuesioner</th>
				<th>Dipublish</th>
				<th>Aksi</th>
			  </thead>
			  <tbody>
				<?php
				  foreach ($data as $key=>$d) {
				?>
				<tr>
				  <td>{{$key+1}}.</td>
				  <td>{{$d['kuesioner_deskripsi']}}</td>
				  <td>{{ date("d/m/Y", strtotime($d['kuesioner_created_date']));}}</td>
				  <td>
						<?php
							if($d['status'] == 0){
						?>
							<a href="user-kuesioner/isi/{{myencrypt($d['kuesioner_id'],"Siperikar@drrc-ui20221")}}" class="btn btn-primary" title="Beri response saya">
								Isi Sekarang &nbsp;
								<i class="fa fa-check" aria-hidden="true"></i>
							</a>
							<?php
							}
							else{
							?>
							<p>Minggu ini anda sudah mengisi kuesioner</p>
							<?php
							}
							?>
          </td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
  </div>
</div>

@endsection