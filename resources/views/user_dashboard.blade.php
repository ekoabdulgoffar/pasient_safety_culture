@extends('dist.layout') 

@section('title')
    PSC | Home
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Dashboard Home</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="user-dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Home PSC</li>
  </ol>
</div>
@endsection 

@section('content')

@if ($data != null)
  @if ($data['mean_total_skor'] < $skor[0]['skor_max'])
  <div class="alert alert-light alert-dismissible" role="alert">
    <div class="row">
      <div class="col-md-2">
        <img src="{{asset('assets/svg/post_test.svg')}}" alt="" srcset="" class="card-img">
      </div>
      <div class="col-md-10">
        <h4 class="font-weight-bold">URGENT !!</h4>
        <p>
          Based on your achievements in filling out the previous questionnaire
          <br>
          You stated that :
        </p>
        @php            
            $pemb = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta voluptates labore obcaecati vitae. Odit, cupiditate.'
        @endphp
        <ul>
          <li>Did not reach the target value of {{$skor[0]['skor_max']}}</li>
          <li>Required to follow <span style="color: blue;" title="{{$pemb}}">the learning program</span></li>          
          <li>Required to fill out the questionnaire again on the tab 'Questionnaire List'</li>
        </ul>
        <a href="pembelajaran" class="btn btn-primary">Go to the learning program page</a>
        @if ($data['edukasi']['tr_edu_isVideo'] == 1 && $data['edukasi']['tr_edu_isPdf'] == 1)
        <a href="user-kuesioner/isi/{{myencrypt($data['kuesioner']['kuesioner_id'],"Pasientsafetyculture@2022")}}" class="btn btn-primary" title="Beri response saya">
          Fill Questionnaire Now &nbsp;
          <i class="fa fa-lock-open" aria-hidden="true"></i>
        </a>
        @else
        <a class="btn btn-secondary" title="Beri response saya" dis>
          Fill Questionnaire Now &nbsp;
          <i class="fa fa-lock" aria-hidden="true"></i>
        </a>
        @endif
      </div>
    </div>
  </div>
  <br>
  @endif  
@endif

<div class="card">
  <div class="card-body">
    <div class="card-title h4 font-weight-bold"><u>Your last activity</u></div>
    <div class="row">
      <div class="col-md-6 mb-3 mb-md-0">
          <p class="font-weight-bold">Completed Questionnaire</p>
          <table class="table table-borderless">
            <tr>
              <td>Questionnaire name</td>
              <td>: {{$data['kuesioner']['kuesioner_deskripsi']}}</td>
            </tr>
            <tr>
              <td>Filling time</td>
              <td>: {{$data['respon']['respon_datetime']}}</td>
            </tr>
            <tr>
              <td>Total score</td>
              <td>: {{$data['total_skor']}}</td>
            </tr>
            <tr>
              <td>Average total score</td>
              <td>: {{number_format($data['mean_total_skor'],2,",","")}}</td>
            </tr>
            <tr>
              <td>Questionnaire result status</td>
              @if ($data['mean_total_skor'] >= $skor[0]['skor_max'])
              <td>: <span class="badge px-2 py-2 bg-success rounded text-light">Success</span></td>
              @else
              <td>: <span class="badge px-2 py-2 bg-danger rounded text-light">Failed</span></td>
              @endif
            </tr>
          </table>
        </div>
        <div class="col-md-6 mb-md">         
          <p class="font-weight-bold">Average result details</p>
          <table class="table table-borderless">
          @foreach ($kelompok as $key=>$item)
          <tr>
            <td>
              <li>{{$item['kelompok_pertanyaan_deskripsi']}}</li>
            </td>
            <td>:
              {{number_format($data['skor_mean'][$key+1],2,",","")}}
            </td>
          </tr>
          @endforeach
          </table> 
        </div>
      </div>
    
  </div>
</div>
<br>
@endsection