@extends('dist.nolayout') 

@section('title') 
PSC 2022 | Thanks note 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-end">  
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">PSC 2022</li>
    <li class="breadcrumb-item active" aria-current="page">Thanks note</li>
  </ol>
</div>
@endsection 

@section('content')
<div class="card">
  <div class="card-header p-1 bg-primary"></div>
  <div class="card-body">
    <div class="card-header" style="color: black">
      <h4>Terima kasih atas partisipasi sejawat dalam pengisian kuesioner ini.</h4>
      {{-- <p class="badge bg-success"><span class="fa fa-check"></span>&nbsp; Hasil Pengisian Berhasil Disimpan! </p> --}}
      <hr>
      <p>
        Hormat kami :
        <br>
        drg. Mita Juliawati,MARS
        <br>
        Mahasiswa Program S3 - Fakultas Kedokteran Gigi Universitas Indonesia 
        <br>
        Telp : <a href="https://wa.me/+6281290888939" target="_blank"> 0812 90 888 939</a>
        <br>
        Email : <a href="mailto:penelitian.psc.mita2020@gmail.com">penelitian.psc.mita2020@gmail.com</a>
      </p>
      <a href="{{url('/user-dashboard')}}" class="btn btn-primary">Selesai</a>
      <br>
    </div>
  </div>
</div>
<div style="height: 30vh"></div>
<br>
@endsection