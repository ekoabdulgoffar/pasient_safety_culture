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
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Riwayat Kuesioner</li> --}}
  </ol>
</div>
@endsection 

@section('content')
@if ($data != null)
  @if ($data[count($data)-1]['mean_total_skor'] < 80)
  <div class="alert alert-light alert-dismissible" role="alert">
    <div class="row">
      <div class="col-md-2">
        <img src="{{asset('assets/svg/post_test.svg')}}" alt="" srcset="" class="card-img">
      </div>
      <div class="col-md-10">
        <h4 class="font-weight-bold">PENTING !!</h4>
        <p>
          Berdasarkan hasil pencapaian anda pada pengisian kuesioner sebelumnya
          <br>
          Anda dinyatakan :
        </p>
        @php
            $post = 'Prosedur post test adalah suatu evaluasi akhir dalam bentuk pertanyaan yang penulis berikan kepada masyarakat sasaran setelah pelajaran/materi telah tersampaikan. Jenis tes yang digunakan yaitu tes objektif';
            $pemb = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta voluptates labore obcaecati vitae. Odit, cupiditate.'
        @endphp
        <ul>
          <li>Tidak mencapai nilai target, yaitu 60</li>
          <li>Diharuskan untuk mengikuti <span style="color: blue;" title="{{$pemb}}">program pembelajaran</span></li>
          <li>Diharuskan untuk melaksanakan <span style="color: blue;" title="{{$post}}">post test</span> terkait program pembelajaran</li>
          <li>Diharuskan untuk mengisi kuesioner kembali pada tab 'Daftar Kuesioner'</li>
        </ul>
        <a href="pembelajaran" class="btn btn-primary">Menuju halaman pembelajaran</a>
      </div>
    </div>
  </div>
  @endif  
@endif



<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item ">
        <a class="nav-link active" data-toggle="tab" href="#rps">Riwayat Pengisian Saya</a>
      </li>
			<li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#dk">Daftar Kuesioner</a>
      </li>
		</ul>
  </div>
  <br>
  <div class="tab-content">
    <div id="rps" class="tab-pane active">
      <div class="table-responsive p-3 table-striped">
        <table class="table align-items-center table-flush table-hover nowrap" id="dataTable">
          <thead class="">
          <th>No</th>
          <th>Waktu pengisian</th>
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
              <td>{{$d['respon']['respon_datetime']}}</td>
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
    <div id="dk" class="tab-pane active fade">
      <div class="table-responsive p-3 table-striped">
        <table class="table align-items-center table-flush table-hover nowrap" id="dataTable2">
          <thead class="">
          <th>No</th>
          <th>Kuesioner</th>
          <th>Dipublish</th>
          <th>Aksi</th>
          </thead>
          <tbody>
          <?php
            foreach ($data2 as $key=>$d) {
          ?>
          <tr>
            <td>{{$key+1}}.</td>
            <td>{{$d['kuesioner_deskripsi']}}</td>
            <td>{{ date("d/m/Y", strtotime($d['kuesioner_created_date']));}}</td>
            <td>
              <?php
                if($d['status'] == 0){
              ?>
                <a href="user-kuesioner/isi/{{myencrypt($d['kuesioner_id'],"Pasientsafetyculture@2022")}}" class="btn btn-primary" title="Beri response saya">
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
</div>

@endsection