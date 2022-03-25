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
    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/user-kuesioner') }}">Riwayat Kuesioner</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail Kuesioner - {{$kuesioner['kuesioner_deskripsi']}}</li>
  </ol>
</div>
@endsection 

@section('content')
<link href="{{ asset('assets-the-event/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />

<div class="row mb-3">
  <div class="col-md-4">
    <div class="card card-body border-left-primary mb-2">      
      Skor<br>
      <span class="h5 font-weight-bold">{{$hasil}}</span>    
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-body border-left-primary mb-2">
      Risiko <br>
      <span class="h5 font-weight-bold">{{$skor['skor_deskripsi']}}</span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card card-body border-left-primary mb-2">
      Waktu pengisian <br>
      <span class="h5 font-weight-bold">{{date("d/m/Y h:m", strtotime($respon['respon_datetime']))}} WIB</span>
    </div>
    
  </div>
</div>
<?php
  $index = 0;
  foreach ($pertanyaan as $p) {
  ?>
  
{{-- MODEL 2 --}}
  <div class="card mb-3">
    <div class="card-header p-1 bg-primary"></div>
    <div class="card-body">
      <div class="row">
        <div class="col">
          @php 
          foreach($kelompok_pertanyaan as $k){ 
            if($k['kelompok_pertanyaan_id'] == $p[0]['kelompok_pertanyaan_id']){
              $kelompok = "collaps_".$k['kelompok_pertanyaan_id'];
              $kelompok_deskripsi = $k['kelompok_pertanyaan_deskripsi'];               
              break; 
            } 
          } 
          @endphp
          <p class="font-weight-bold">
            Kelompok : {{$kelompok_deskripsi}}
          </p>
        </div>
        <div class="col">          
        </div>
      </div>
        <table>
          <?php
        foreach($p as $key=>$pertanyaan_satuan){ 
          ?>
          <tr>
            <td class="align-top">{{$key+1}}.&nbsp;&nbsp;</td>
            <td class="w-100">
              <p class="mb-1">
                {{$pertanyaan_satuan['pertanyaan_']}} <span class="text-danger">*</span>
              </p>
              <?php
              foreach ($jenis_pertanyaan as $jp) {
              if($jp['jenis_pertanyaan_id'] == $pertanyaan_satuan['jenis_pertanyaan_id']){
                $param = json_decode($jp['jenis_pertanyaan_parameter'], true);
                foreach ($param as $prm) {
                  
            ?>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" 
                  name="poin:{{$pertanyaan_satuan['pertanyaan_id']}}" 
                  id="{{$pertanyaan_satuan['pertanyaan_id']}}" 
                  value="{{$prm['poin']}}" 
                  @php echo $drespon[$index]['drespon_jawaban'] == $prm['poin'] ? 'checked' : 'disabled' @endphp
                  />
                <label class="form-check-label" for="inlineRadio1">{{$prm['param']}} - {{$index}}</label>
              </div>
              <?php
                  }
                break;
              }
              }
            ?>
              <br />
              <input type="text" style="display: @php echo $drespon[$index]['drespon_keterangan'] == "-" ? 'block' : 'block' @endphp" class="form-control mb-2 mt-2" id="ket:{{$pertanyaan_satuan['pertanyaan_id']}}"  name="ket:{{$pertanyaan_satuan['pertanyaan_id']}}" placeholder="{{$pertanyaan_satuan['pertanyaan_keterangan']}}" value="{{$drespon[$index]['drespon_keterangan']}}" disabled/>
            </td>        
          </tr>
          <tr style="height: 15px"></tr>
          <?php
          $index++;
        }
      ?>
        </table>
    </div>
  </div>
{{-- END MODEL 2 --}}
<?php
  }
  ?>
  <a href="{{ url('/user-kuesioner') }}" class="btn btn-secondary mb-3">
    Kembali
  </a>

<script src="{{ asset('assets/js/user_isi_kuesioner.js') }}"> </script>
@endsection
