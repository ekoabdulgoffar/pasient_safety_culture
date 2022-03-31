@extends('dist.layout') 

@section('title') 
SIM PERIKAR | Isi Kuesioner 
@endsection 

@section('menu') 
@include('dist.menu_user') 
@endsection 

@section('content-header-info')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">{{$kuesioner['kuesioner_deskripsi']}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/user-kuesioner') }}">Questionnaire History</a></li>
    <li class="breadcrumb-item active" aria-current="page">Isi Kuesioner - {{$kuesioner['kuesioner_deskripsi']}}</li>
  </ol>
</div>
@endsection @section('content')
<form action="{{ url('/isi-kuesioner') }}" method="POST">
  @csrf
  <input type="hidden" name="kuesioner_id" value="{{$kuesioner['kuesioner_id']}}">
<?php 
  foreach ($pertanyaan as $p) {
  ?>
  
{{-- MODEL 2 --}}
  <div class="card mb-3">
    <div class="card-header p-1 bg-primary"></div>
    <div class="card-body">
      @php 
      foreach($kelompok_pertanyaan as $k){ 
        if($k['kelompok_pertanyaan_id'] == $p[0]['kelompok_pertanyaan_id']){
          $kelompok = "collaps_".$k['kelompok_pertanyaan_id'];
          $kelompok_deskripsi = $k['kelompok_pertanyaan_deskripsi'];               
          break; 
        } 
      } 
      @endphp
      <div class="row" data-toggle="collapse" href="#{{$kelompok}}" role="button" aria-expanded="false" aria-controls="{{$kelompok}}" style="cursor: pointer;">
        <div class="col">
          <p class="font-weight-bold">
            Kelompok : {{$kelompok_deskripsi}}
          </p>
        </div>
        <div class="col">
          <a class="float-right">
            <i class="fa fa-plus" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <div class="collapse" id="{{$kelompok}}">
        <table>
          <?php
        foreach($p as $key=>$pertanyaan_satuan){ ?>
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
                  value="{{$prm['poin']}}" required checked
                  onchange="@php echo $prm['param'] == "Ya" ? 'show' : 'hide' @endphp('ket:{{$pertanyaan_satuan['pertanyaan_id']}}')"
                  />
                <label class="form-check-label" for="inlineRadio1">{{$prm['param']}}</label>
              </div>
              <?php
                  }
                break;
              }
              }
            ?>
              <br />
              <input type="text" style="display: none" class="form-control mb-2 mt-2" id="ket:{{$pertanyaan_satuan['pertanyaan_id']}}"  name="ket:{{$pertanyaan_satuan['pertanyaan_id']}}" placeholder="{{$pertanyaan_satuan['pertanyaan_keterangan']}}" />
            </td>        
          </tr>
          <tr style="height: 15px"></tr>
          <?php
        }
      ?>
        </table>
      </div>
    </div>
  </div>
{{-- END MODEL 2 --}}
<?php
  }
  ?>
  <a href="{{ url('/user-kuesioner') }}" class="btn btn-secondary">
    Kembali
  </a>
  <input type="submit" value="Selesai" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengirimkan jawaban ini?')"/>
</form>

<script src="{{ asset('assets/js/user_isi_kuesioner.js') }}"> </script>
@endsection
