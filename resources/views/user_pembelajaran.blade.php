@extends('dist.layout') 

@section('title')
    PSC 2022 | Pembelajaran
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Program Pembelajaran</h1>
  <ol class="breadcrumb">
	<li class="breadcrumb-item" aria-current="page"><a href="Dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Progam pembelajaran</li>
  </ol>
</div>
@endsection 

@section('content')
    <script src="{{ asset('assets/js/user_pembelajaran.js')}}"></script>
    <style>
      .iframe{
          height: 480px;
        }
      @media (min-width: 1025px){
        .iframe{
          height: 600px;
        }
      }
    </style>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-9">
            <div class="tab-content">
              <div id="pdf" class="tab-pane active">
                <div class="row mb-1">
                  <div class="col">
                    <p>{{$file['edu_desk_pdf']}}</p>
                  </div>
                  <div class="col">
                    @if ($edukasi['tr_edu_isPdf'] == 0)
                    <form action="update-pembelajaran/{{myencrypt(1,"Pasientsafetyculture@2022")}}" method="post">
                      @csrf
                      <input type="submit" class="btn btn-success float-right" value="Tekan jika anda sudah mengerti">
                    </form>
                    @else
                    <button style="cursor: not-allowed" class="btn btn-info float-right" >Anda telah mengerti pembelajaran ini</button>
                    @endif
                  </div>
                </div>
                <iframe src="{{$file['edu_file_pdf']}}" width="100%" class="iframe" allow="autoplay"></iframe>
              </div>
              <div id="video" class="tab-pane fade">
                <div class="row mb-1">
                  <div class="col">
                    <p>{{$file['edu_desk_video']}}</p>
                  </div>
                  <div class="col">
                    @if ($edukasi['tr_edu_isVideo'] == 0)
                    <form action="update-pembelajaran/{{myencrypt(2,"Pasientsafetyculture@2022")}}" method="post">
                      @csrf
                      <input type="submit" class="btn btn-success float-right" value="Tekan jika anda sudah mengerti">
                    </form>
                    @else
                    <button style="cursor: not-allowed" class="btn btn-info float-right" >Anda telah mengerti pembelajaran ini</button>
                    @endif
                  </div>
                </div>
                <iframe src="{{$file['edu_file_video']}}" width="100%" class="iframe" allow="autoplay"></iframe>
              </div>
            </div>
            
          </div>
          <div class="col-md-3">
            <p>Daftar menu pembelajaran</p>
            <ul class="nav flex-column" style="row-gap: 5px">
              <li class="nav-item ">
                <a class="nav-link border-left-dark" data-toggle="tab" href="#pdf" id='link1' onclick="tes(1)">Pembelajaran PDF</a>
              </li>
              <li class="nav-item ">
                <a class="nav-link" data-toggle="tab" href="#video" id='link2' onclick="tes(2)">Pembelajaran Video</a>
              </li>
              <li class="nav-item ">
                @if ($edukasi['tr_edu_isPdf'] == 1 && $edukasi['tr_edu_isVideo'] == 1)
                <a class="nav-link" href="post-test">Menuju halaman post test</a>
                @else
                <a class="nav-link disabled" href="">Menuju halaman post test</a>
                @endif
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
@endsection