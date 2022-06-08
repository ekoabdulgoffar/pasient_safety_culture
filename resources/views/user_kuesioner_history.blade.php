@extends('dist.layout') 

@section('title')
    PSC 2022 | Questionnaire History
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Questionnaire History</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">{{env('APP_NAME')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">Questionnaire History</li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Questionnaire History</li> --}}
  </ol>
</div>
@endsection 

@section('content')
@php
    $alasan = 'This happens because your previous questionnaire did not meet the requirements, please do the learning program first'
@endphp
<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
			<li class="nav-item ">
        <a class="nav-link active" data-toggle="tab" href="#rps">My Questionnaire Filling History</a>
      </li>
			<li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#dk">Questionnaire List</a>
      </li>
		</ul>
  </div>
  <br>
  <div class="tab-content">
    <div id="rps" class="tab-pane active">
      <div class="table-responsive p-3 table-striped">
        <table class="table align-items-center table-flush table-hover nowrap" id="dataTable">
          <thead>
          <th>No</th>
          <th>Filling time</th>
          @foreach ($kelompok as $k)
              <th>x̄ {{$k['kelompok_pertanyaan_deskripsi']}}</th>
          @endforeach
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
          <th>Questionnaire</th>
          <th>Published</th>
          <th>Action</th>
          </thead>
          <tbody>
          @foreach ($data2 as $key=>$d)
          <tr>
            <td class="align-middle">{{$key+1}}.</td>
            <td class="align-middle">{{$d['kuesioner_deskripsi']}}</td>
            <td class="align-middle">{{ date("d/m/Y", strtotime($d['kuesioner_created_date']));}}</td>
            <td class="align-middle">
              @if ($data != null && $data[count($data)-1]['mean_total_skor'] <  $skor[0]['skor_max'] && $d['kuesioner_available'] == false)
              <p>
                You cannot fill out this questionnaire
                <span class="fa fa-info-circle" data-toggle="modal" data-target="#exampleModalCenter" style="cursor: pointer"></span>
              </p>
              @else
              @if ($data != null && $data[count($data)-1]['mean_total_skor'] > $skor[0]['skor_max'])
              <p>You have completed this questionnaire <span class="fa fa-graduation-cap"></span></p>
              @else
              <a href="user-kuesioner/isi/{{myencrypt($d['kuesioner_id'],"Pasientsafetyculture@2022")}}" class="btn btn-primary" title="Beri response saya">
                Fiasdll Now &nbsp;
                <i class="fa fa-check" aria-hidden="true"></i>
              </a>
              @endif
              @endif
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-dark" style="background-color: #e3eaef">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">
          Information
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mb-3">
        <div class="d-flex justify-content-center">
          <img class="card-img text-center col-md-8" src="{{asset('assets/svg/info.svg')}}"/>
        </div>
        <br>
        {{$alasan}}
      </div>
    </div>
  </div>
</div>
<br>
@endsection