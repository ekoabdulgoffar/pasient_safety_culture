<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link href="https://seeklogo.com/images/P/pdgi-logo-FDDED04156-seeklogo.com.png" rel="icon" />
  <title>Patient Safety Culture</title>
  @include('dist.css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,100&display=swap" rel="stylesheet">
</head>
<style>
  p{
    margin:0
  }
</style>
<body style="font-family: 'Poppins', sans-serif;">
  <div class="border border-bottom">
    <div class="container">
      {{-- MAVNAR --}}
      <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="#" style="font-weight: 300; font-size: 16px">
          <!--<img src="https://seeklogo.com/images/P/pdgi-logo-FDDED04156-seeklogo.com.png" alt="" width="30" height="24">-->
          {{env('APP_NAME')}}
        </a>
        <a href="{{ url('/login') }}" style="text-decoration: none;" class="btn btn-outline-primary">
          <span class="fa fa-home"></span>
          Login
        </a>
      </nav>

    </div>
  </div>
  <div class="container mt-3">
    {{-- CONTENT --}}    
    <div class="card mt-5">
      <div class="card-body">
        <div class="card card-body bg-primary text-light text-center">
          <p>
            Selamat Datang di <b>Website BUDAYA KESELAMATAN PASIEN pada bidang Kedokteran Gigi di Indonesia</b>
          </p>
          <hr style="border-color: white">
          <p>
            Welcome to the Website <b>PATIENT SAFETY CULTURE in DENTISTRY in Indonesia</b>
          </p>
        </div>
        <br>
        <div class="row">
          <div class="col-md-6">
            <p class="font-weight-bold">Jumlah responden kami : {{$responden}} responden</p>
          </div>
          <div class="col-md-6">
            <a href="{{ url('/login') }}" style="text-decoration: none; float: right;"><span class="fa fa-sign"></span> Jadilah bagian dari kami</a>
          </div>
        </div>
        <hr>
        <p>Saat ini terdapat <b>{{count($kuesioner)}}</b> survey</p>
        <br>
        @foreach ($kuesioner as $key=>$item)      
        <div class="card card-body border-left-success">
          <h5 class="font-weight-bold">{{$item['kuesioner_deskripsi']}}</h5>    
			<div class="row">
				<div class="col-sm-4">
					<img src="{{ asset('assets/image/img_kuesioner_01.jpeg') }}" alt="" width="100%" height="auto">
				</div>
				<div class="col-sm-8">
					<table class="table table-borderless">
					<tr>
					  <td>Jumlah data survey saat ini</td>
					  <td>: </td>
					  <td class="float-right">{{$respon[$key]}}</td>
					</tr>
					<tr>
					  <td>Jumlah pertanyaan</td>
					  <td>: </td>
					  <td class="float-right">{{$pertanyaan[$key]}}</td>
					</tr>
				  </table> 
				</div>
			</div>
			           
          <hr class="my-3">
          <div class="d-flex">
            <a href="{{ url('user-kuesioner/isi/'.myencrypt($item['kuesioner_id'],"Pasientsafetyculture@2022")); }}" class="btn btn-success"><span class="fa fa-list"></span> Mulai survey</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
	<br><br><br><br>
    
  </div>
		<footer class="sticky-footer bg-white">
			<div class="container my-auto">
			  <div class="copyright text-center my-auto">
				<span>Copyright &copy; <script> document.write(new Date().getFullYear()); </script> - {{env('APP_NAME')}} </span>
			  </div>
			</div>
		  </footer>
</body>
</html>