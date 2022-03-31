@extends('dist.layout') 

@section('title')
    PSC 2022 | Result post test
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Post test</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post test</li>
    <li class="breadcrumb-item active" aria-current="page">Result</li>
  </ol>
</div>
@endsection 


@section('content')
@php
    if(!isset($nilai)){
      $nilai = 80;
    }
@endphp
@if ($nilai > 60)
<div class="d-flex justify-content-center">
  <div class="card col-md-4 alert-success">
    <div class="card-body text-center text-light">
      <img src="{{asset('assets/svg/post_test_success.svg')}}" alt="" srcset="" class="card-img col-md-8">
      <hr>
      <p>
        Your Result
        <br>
        <span class="h1">{{number_format($nilai,2,",","")}}</span>
        <br>
        <small>Now you can fill out the questionnaire again <a href="user-kuesioner/isi/{{myencrypt(1,"Pasientsafetyculture@2022")}}">click here</a></small>
      </p>    
    </div>
  </div>
</div>
@else
<div class="d-flex justify-content-center">
  <div class="card col-md-4 alert-danger">
    <div class="card-body text-center text-light">
      <img src="{{asset('assets/svg/post_test_failed.svg')}}" alt="" srcset="" class="card-img col-md-8">
      <hr>
      <p>
        Your Result
        <br>
        <span class="h1">{{number_format($nilai,2,",","")}}</span>
        <br>
        <small>Sorry, your results were too low to fill out the questionnaire again.</small>
        <br>
        <small>You can repeat the learning program by clicking <a href="pembelajaran">here</a></small>
      </p>    
    </div>
  </div>
</div>
@endif
@endsection