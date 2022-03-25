@extends('dist.layout') 

@section('title')
    SIM PERIKAR | Riwayat Kuesioner
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Riwayat Kuesioner</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">SIM PERIKAR</a></li>
    <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li> --}}
  </ol>
</div>
@endsection 


{{-- CARD --}}
{{-- @section('content')
<div class="row">
  <?php
      foreach ($data as $d) {
  ?>
  <div class="col-md-6 mb-3">
    <div class="card">      
      <div class="card-body 
      @php
        echo ($d['status'] == 0 ? 'border-left-danger' : 'border-left-success')
      @endphp ">
        <div class="d-flex justify-content-between mb-0">
          <p>
            {{$d['kuesioner']['kuesioner_deskripsi']}}
          </p>
          <p>Dibuat pada {{ date("d/m/Y", strtotime($d['kuesioner']['kuesioner_created_date']));}}</p>
        </div>
        <hr class="mt-0"/>
        <div class="row">
          <div class="col">
            Status pengisian
          </div>
          <div class="col">
            @php
              echo ($d['status'] == 0 ? ': <del>Sudah</del> / Belum' : ': Sudah / <del>Belum</del>')
            @endphp
          </div>
        </div>
        <div class="row">
          <div class="col">
            Waktu pengisian
          </div>
          <div class="col">
            : 
            @php
              echo ($d['status'] == 0 ? '-' : date("d/m/Y h:m", strtotime($d['kuesioner']['kuesioner_created_date'])));
              echo $d['status'] == 1 ? ' WIB' : '';
            @endphp
          </div>
        </div>
        <div class="row">
          <div class="col">
            Hasil skor
          </div>
          <div class="col">
            : {{$d['hasil']}} / 100
          </div>
        </div>
        <div class="row">
          <div class="col">
            Hasil risiko
          </div>
          <div class="col">
            : <strong>{{ $d['risiko']}}</strong>
          </div>
        </div>
        <div class="row">
          <div class="col">
            Aksi
          </div>
          <div class="col">
            :
            <?php
              if($d['status'] == 0) {
            ?>
            <a href="user-kuesioner/isi-kuesioner/{{$d['kuesioner']['kuesioner_id']}}" class="btn btn-primary" title="Beri response saya">
              Isi Sekarang &nbsp;
              <i class="fa fa-check" aria-hidden="true"></i>
            </a>
            <?php } ?>
            <?php          
              if($d['status'] == 1) {
            ?>
            <a href="" class="btn btn-success" title="Edit response saya">
              Edit &nbsp;
              <i class="fa fa-book" aria-hidden="true"></i>
            </a>
            <a href="user-kuesioner/detail/{{myencrypt($d['kuesioner']['kuesioner_id'],"Siperikar@drrc-ui20221")}}" class="btn btn-warning" title="Lihat response saya">
              Lihat Kuesioner &nbsp;
              <i class="fa fa-info" aria-hidden="true"></i>
            </a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
</div>
@endsection --}}

@section('content')
<!-- Row -->
<div class="row">
	<!-- Datatables -->
	<div class="col-lg-12">
	  <div class="card mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
		  <h6 class="m-0 font-weight-bold text-primary">Data Riwayat Pengisian</h6>
		</div>
		<div class="table-responsive p-3">
			<table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
			  <thead>
				<th>No</th>
				<th>Kuesioner</th>
				<th>Dipublish</th>
				<th>Status</th>
				<th>Skor</th>
				<th>Risiko</th>
				<th>Waktu pengisian</th>
				<th>Aksi</th>
			  </thead>
			  <tbody>
				<?php
				  foreach ($data as $key=>$d) {
				?>
				<tr>
				  <td>{{$key+1}}.</td>
				  <td>{{$d['kuesioner']['kuesioner_deskripsi']}}</td>
				  <td>{{ date("d/m/Y", strtotime($d['kuesioner']['kuesioner_created_date']));}}</td>
				  <td>
					@php
					  echo ($d['status'] == 0 ? '<p class="text-danger">Belum</p>' : '<p class="text-success">Sudah</p>')
					@endphp
				  </td>
				  <?php
					$hasil_temp = "";
					if (!isset($d['hasil']))$hasil_temp = number_format($d['hasil'],2,",",""); 
					else $hasil_temp = "";
				  ?>
				  <td>{{ $hasil_temp }}</td>
				  <td>{{ $d['risiko']}}</td>
				  <td>
					@php
					  echo ($d['status'] == 0 ? '-' : date("d/m/Y h:m", strtotime($d['respon']['respon_datetime'])));
					  echo $d['status'] == 1 ? ' WIB' : '';
					@endphp
				  </td>
				  <td>
					<?php
					  if($d['status'] == 0) {
					?>
					<a href="user-kuesioner/isi/{{myencrypt($d['kuesioner']['kuesioner_id'],"Siperikar@drrc-ui20221")}}" class="btn btn-primary" title="Beri response saya">
					  Isi Sekarang &nbsp;
					  <i class="fa fa-check" aria-hidden="true"></i>
					</a>
					<?php } ?>
					<?php
					  if($d['status'] == 1) {
					?>
					<a href="user-kuesioner/edit/{{myencrypt($d['kuesioner']['kuesioner_id'],"Siperikar@drrc-ui20221")}}" class="btn btn-success" title="Edit response saya">
					  Edit &nbsp;
					  <i class="fa fa-book" aria-hidden="true"></i>
					</a>
					<a href="user-kuesioner/detail/{{myencrypt($d['kuesioner']['kuesioner_id'],"Siperikar@drrc-ui20221")}}" class="btn btn-warning" title="Lihat response saya">
					  Lihat Kuesioner &nbsp;
					  <i class="fa fa-info" aria-hidden="true"></i>
					</a>
					<?php } ?>
				  </td>
				</tr>
				<?php } ?>
			  </tbody>
			</table>
		</div>
	  </div>
	</div>	
</div>
@endsection