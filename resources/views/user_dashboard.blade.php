@extends('dist.layout') 

@section('title')
    PSC | Beranda
@endsection

@section('menu')
@include('dist.menu_user') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h5 mb-0 text-gray-800">Dashboard Beranda</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="user-dashboard">Pasient Safety Culture</a></li>
    <li class="breadcrumb-item active" aria-current="page">Beranda PSC</li>
  </ol>
</div>
@endsection 

@section('content')

@endsection