@extends('dist.layout') 

@section('title')
    PSC 2022 | Post test
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
    {{-- <li class="breadcrumb-item active" aria-current="page">Questionnaire History</li> --}}
  </ol>
</div>
@endsection 


@section('content')

<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col">
        <h5 class="font-weight-bold">{{$post_test['post_test_deskripsi']}}</h5>
      </div>
      <div class="col">
        <p class="float-right">
          Have a great time doing it
        </p>
      </div>
    </div>
    <form action="submit-post-test" method="post">
      @csrf
      @foreach ($pertanyaan as $key=>$item)
      <div style="background-color: whitesmoke" class="p-2">      
        <b>{{$key+1}}. {{$item['pertanyaan_post_']}}</b>
        <br>
        @foreach (json_decode($item['pertanyaan_post_pilihan'], true) as $index=>$p)
          <input class="ml-3" type="radio" value="{{$index}}" name="ans-{{$item['pertanyaan_post_id']}}" id="" required> &nbsp; &nbsp;{{$p}}
          <br>
        @endforeach
      </div>
      <br>
      @endforeach
      <a href="pembelajaran" class="btn btn-secondary">Back</a>
      <input type="submit" value="Send" class="btn btn-primary" onclick="return confirm('Are you sure you want to submit this answer?')">
      <p class="text-center">- Have a great time doing it -</p>
    </form>
  </div>
</div>
    
@endsection