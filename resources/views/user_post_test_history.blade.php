@extends('dist.layout') 

@section('title')
    PSC 2022 | Post Test History
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Post Test History</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Post Test History</li>
    {{-- <li class="breadcrumb-item active" aria-current="page">Questionnaire History</li> --}}
  </ol>
</div>
@endsection 

@section('content')
<div class="card">
  <div class="card-body">
    <div class="table-responsive p-3 table-striped">
      <table class="table align-items-center table-flush table-hover nowrap" id="dataTable">
        <thead>
          <th>No</th>
          <th>Filling time</th>
          <th>Score</th>
          <th>Result</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($post_test as $key=>$item)
          <tr>
            <td>{{$key+1}}.</td>
            <td>{{$item['respon_post_datetime']}}</td>
            <td>{{number_format($item['nilai'],2,",","")}}</td>
            <td>
              @if ($item['respon_post_status'] == 1)
              <p class="badge px-2 py-2 bg-success rounded text-light">Success</p>
              @else
              <p class="badge px-2 py-2 bg-danger rounded text-light">Failed</p>
              @endif
            </td>
            <td>
              No action to show
              {{-- <a class="btn btn-info" href="post-test-result/{{myencrypt($item['respon_post_id'],"Pasientsafetyculture@2022")}}">
                Show details score &nbsp;<i class="fa fa-info"></i>
              </a> --}}
            </td>
          </tr>
          @endforeach 
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
@endsection