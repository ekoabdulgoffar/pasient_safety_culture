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
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
  <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
  <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>HOME</h3>
    <p>Some content.</p>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Menu 1</h3>
    <p>Some content in menu 1.</p>
  </div>
  <div id="menu2" class="tab-pane fade">
    <h3>Menu 2</h3>
    <p>Some content in menu 2.</p>
  </div>
</div>
<hr>
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="">Riwayat Pengisian Saya</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="user-kuesioner-kuesioner">Daftar Kuesioner</a>
      </li>
    </ul>
  </div>
  <br>
  <div class="">
    <div class="table-responsive p-3 table-striped">
			<table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
			  <thead class="">
				<th>No</th>
				<th>Kuesioner</th>
				<th>Waktu pengisian</th>
				<th>Total Skor</th>
				<th>x̄ Kerja Tim</th>
				<th>x̄ Safety</th>
				<th>x̄ Kepuasan Kerja</th>
				<th>x̄ Pengakuan Kondisi Stress</th>
				<th>x̄ Persepsi Manajemen</th>
				<th>x̄ Kondisi Kerja</th>
				<th>x̄ Total Skor</th>
			  </thead>
			  <tbody>
					@foreach ($data as $key => $d)
					<tr>
						<td>{{$key+1}}</td>
						<td>{{$d['kuesioner']['kuesioner_deskripsi']}}</td>
						<td>{{$d['respon']['respon_datetime']}}</td>
						<td>{{$d['total_skor']}}</td>
						@foreach ($d['skor_mean'] as $item)
							@if ($item != -1)
							<td>{{number_format($item,2,",","")}}</td>
							@endif
						@endforeach
						
						<td>{{number_format($d['mean_total_skor'],2,",","")}}</td>
					</tr>
					@endforeach
			  </tbody>
			</table>
		</div>
  </div>
</div>

@endsection