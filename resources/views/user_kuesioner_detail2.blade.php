@extends('dist.layout') 

@section('title') 
SIM PERIKAR | Detail Kuesioner 
@endsection 

@section('menu') 
@include('dist.menu_user') 
@endsection 

@section('content-header-info')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">{{$kuesioner['kuesioner_deskripsi']}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/user-kuesioner') }}">Questionnaire History</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Kuesioner - {{$kuesioner['kuesioner_deskripsi']}}</li>
  </ol>
</div>
@endsection 

@section('content')
<link href="{{ asset('assets-the-event/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />

<div class="">
  <div class="card card-body">
    <p class="h6">Detail response</p>
    <div class="table-responsive p-3 table-striped">
      <table class="table align-items-center table-flush table-hover nowrap" id="dataTableHover">
        <thead>
          <th>No.</th>
          <th>Kategori</th>
          <th>Prosentase</th>
        </thead>
        <tbody>
          {{-- DETAIL PENGISIAN --}}
          <?php
              $index = 0;
              $i = 0;
              foreach($pertanyaan as $p){
                foreach($kelompok_pertanyaan as $k){
                  if($k['kelompok_pertanyaan_id'] == $p[0]['kelompok_pertanyaan_id']){
                    $kelompok = "collaps_".$k['kelompok_pertanyaan_id'];
                    $kelompok_deskripsi = $k['kelompok_pertanyaan_deskripsi'];               
                    break;
                  }
                }
                $prosentase = 0.0;
                $prosentase_total = 0.0;
                foreach ($p as $key => $pert) {
                  if($drespon[$i]['drespon_jawaban'] != -1){
                    $prosentase++;
                  }
                  $prosentase_total++;
                  $i++;
                }            
                $prosentase = $prosentase / count($drespon);
                $prosentase = number_format($prosentase,2,",","");
                $prosentase_total = $prosentase_total / count($drespon);
                $prosentase_total = number_format($prosentase_total,2,",","");
          ?>
          <tr>
            <td>{{$index+1}}.</td>
            <td>{{$kelompok_deskripsi}}</td>
            <td>{{$prosentase}} / {{$prosentase_total}}%</td>
          </tr>
          <?php $index++; } ?>
          <tr class="font-weight-bold bg-dark text-light">
            <td colspan="2">Risiko Kebakaran Tingkat RW</td>
            <td>{{number_format($hasil,2,",","");}} / 100%</td>
          </tr>
          <tr class="font-weight-bold bg-primary text-light">
            <td colspan="2">Status Risiko</td>
            <td>{{$skor['skor_deskripsi']}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
  <a href="{{ url('/user-kuesioner') }}" class="btn btn-secondary mb-3">
    Kembali
  </a>

<script src="{{ asset('assets/js/user_isi_kuesioner.js') }}"> </script>
@endsection
