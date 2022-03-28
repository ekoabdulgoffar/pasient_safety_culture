@extends('dist.layout') 

@section('title') 
PSC 2022 | Isi Kuesioner 
@endsection 

@section('menu') 
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">{{$kuesioner['kuesioner_deskripsi']}}</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="{{ url('/user-kuesioner') }}">Riwayat Kuesioner</a></li>
    <li class="breadcrumb-item active" aria-current="page">Isi Kuesioner - {{$kuesioner['kuesioner_deskripsi']}}</li>
  </ol>
</div>
@endsection 

@section('content')
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />

<form action="{{ url('/isi-kuesioner') }}" method="POST">
  @csrf
  <input type="hidden" name="kuesioner_id" value="{{$kuesioner['kuesioner_id']}}" />
  <?php 
  foreach ($pertanyaan as $p) {
  ?>

  {{-- MODEL 2 --}}
  <div class="card mb-3">
    <div class="card-header p-1 bg-primary"></div>
    <div class="card-body">
      @php foreach($kelompok_pertanyaan as $k){ if($k['kelompok_pertanyaan_id'] == $p[0]['kelompok_pertanyaan_id']){ $kelompok = "collaps_".$k['kelompok_pertanyaan_id']; $kelompok_deskripsi = $k['kelompok_pertanyaan_deskripsi']; $icon =
      "icon_".$k['kelompok_pertanyaan_id']; break; } } @endphp
      <div class="row" data-toggle="collapse" href="#{{$kelompok}}" onclick="changeIcon('{{$kelompok}}')" role="button" aria-expanded="false" aria-controls="{{$kelompok}}" style="cursor: pointer;">
        <div class="col">
          <p class="font-weight-bold">
            {{$kelompok_deskripsi}}
          </p>
        </div>
        <div class="col">
          <a class="float-right" id="icon_{{$kelompok}}">
            <i class="bi bi-caret-up-fill"></i>
          </a>
        </div>
      </div>
      <div class="collapse show" id="{{$kelompok}}">
        <table>
          <?php
        foreach($p as $key=>$pertanyaan_satuan){ ?>
          <tr style="background-color: whitesmoke;" class="text-dark">
            <td class="align-top p-2 font-weight-bold">{{$key+1}}.</td>
            <td class="w-100 p-2">
              <p class="mb-1 font-weight-bold">{{$pertanyaan_satuan['pertanyaan_']}} <span class="text-danger">*</span></p>
              @foreach ($jenis_pertanyaan as $jp)
                  @if ($jp['jenis_pertanyaan_id'] == $pertanyaan_satuan['jenis_pertanyaan_id'])
                      @php
                          $param = json_decode($jp['jenis_pertanyaan_parameter'], true);
                      @endphp
                      @if (count($param) > 0)
                          @foreach ($param as $prm)
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" 
                            name="poin:{{$pertanyaan_satuan['pertanyaan_id']}}" 
                            id="{{$pertanyaan_satuan['pertanyaan_id']}}"
                            @if ($prm['poin'] != -1)
                            value="{{$prm['nilai']}}" 
                            @else
                            value="{{$prm['param']}}" 
                            @endif
                            required checked />
                            <label class="form-check-label" for="inlineRadio1">{{$prm['param']}}</label>
                          </div>
                          @endforeach
                      @else
                      <input
                          type="text"
                          class="form-control mb-2 mt-2"
                          id="{{$pertanyaan_satuan['pertanyaan_id']}}"
                          name="poin:{{$pertanyaan_satuan['pertanyaan_id']}}" 
                          placeholder="isi jawaban anda di sini"
                          required
                        />
                      @endif
                  @endif
              @endforeach
              
              <br />
            </td>
          </tr>
          <tr style="height: 15px;"></tr>
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
  <input type="submit" value="Selesai" class="btn btn-primary" onclick="return confirm('Apakah anda yakin ingin mengirimkan jawaban ini?')" />
</form>
<br>
<script src="{{ asset('assets/js/user_isi_kuesioner.js') }}"></script>
@endsection
