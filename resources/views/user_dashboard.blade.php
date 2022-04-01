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
    @if ($post_test['respon_post_status'] == 0 || $post_test == null)
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
              $post = 'The post test procedure is the final evaluation in the form of questions that the author gives to the target community after the lesson/material has been delivered. The type of test used is an objective test';
              $pemb = 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta voluptates labore obcaecati vitae. Odit, cupiditate.'
          @endphp
          <ul>
            <li>Did not reach the target value of {{$skor[0]['skor_max']}}</li>
            <li>Required to follow <span style="color: blue;" title="{{$pemb}}">the learning program</span></li>
            <li>Required to carry out a <span style="color: blue;" title="{{$post}}">post test</span> related to the learning program</li>
            <li>Required to fill out the questionnaire again on the tab 'Questionnaire List'</li>
          </ul>
          <a href="pembelajaran" class="btn btn-primary">Go to the learning program page</a>
        </div>
      </div>
    </div>
    @else
    <a href="user-kuesioner/isi/{{myencrypt($data['kuesioner']['kuesioner_id'],"Pasientsafetyculture@2022")}}" class="btn btn-primary" title="Beri response saya">
      Fill Questionnaire Now &nbsp;
      <i class="fa fa-check" aria-hidden="true"></i>
    </a>
    <br>
    <br>
    @endif
  @endif  
@endif

<div class="card">
  <div class="card-body">
    <div class="card-title h6 font-weight-bold">Your last activity</div>
    <div class="row">
      <div class="col-md-6">
        <div class="card card-body">
          <p class="font-weight-bold">Completed Questionnaire</p>
          <table>
            <tr>
              <td>Questionnaire name</td>
              <td>: {{$data['kuesioner']['kuesioner_deskripsi']}}</td>
            </tr>
            <tr>
              <td>Published</td>
              <td>: {{$data['kuesioner']['kuesioner_modified_date']}}</td>
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
              @if ($data['mean_total_skor'] > $skor[0]['skor_max'])
              <td>: <span class="badge px-2 py-2 bg-success rounded text-light">Success</span></td>
              @else
              <td>: <span class="badge px-2 py-2 bg-danger rounded text-light">Failed</span></td>
              @endif
            </tr>
          </table>
          <hr>
          <p class="font-weight-bold">Average result details</p>
          <table>
          @foreach ($kelompok as $key=>$item)
          @if ($item['kelompok_pertanyaan_deskripsi'] != 'Pribadi')
          <tr>
            <td>
              <li>{{$item['kelompok_pertanyaan_deskripsi']}}</li>
            </td>
            <td>:
              {{number_format($data['skor_mean'][$key],2,",","")}}
            </td>
          </tr>
          @endif
          @endforeach
          </table>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card card-body">
          <p class="font-weight-bold">Completed Post Test</p>
          @if (isset($last_post))
          <table>
            <tr>
              <td>Post test name</td>
              <td>: {{$last_post['post_test_deskripsi']}}</td>
            </tr>
            <tr>
              <td>Published</td>
              <td>: {{$last_post['post_test_datetime']}}</td>
            </tr>
            <tr>
              <td>Filling time</td>
              <td>: {{$last_post['respon_post_datetime']}}</td>
            </tr>
            <tr>
              <td>Total score</td>
              <td>: {{number_format($last_post['nilai'],2,",","")}}</td>
            </tr>
            <tr>
              <td>Post test result status</td>
              @if ($last_post['nilai'] > $skor[1]['skor_max'])
              <td>: <span class="badge px-2 py-2 bg-success rounded text-light">Success</span></td>
              @else
              <td>: <span class="badge px-2 py-2 bg-danger rounded text-light">Failed</span></td>
              @endif
            </tr>
            
          </table>
          @else
          <p>No data to display</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
<br>
@endsection