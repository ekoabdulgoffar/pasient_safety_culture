@extends('dist.layout') 


@section('title')
    SIM PERIKAR | Dashboard MAP
@endsection

@section('menu')
@include('dist.menu_admin') 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard MAP</h1>
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="Dashboard">SIM PERIKAR</a></li>
    <li class="breadcrumb-item active" aria-current="page">Dashboard MAP</li>
  </ol>
</div>
@endsection 

@section('content')

<div class="row">
  <div class="col">
    <p>Peta sebaran risiko kebakaran</p>
  </div>
  <div class="col">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModalCenter">
      Lihat Keterangan
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Keterangan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Skor</th>
                  <th scope="col">Status</th>
                  <th scope="col">Icon</th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach($skor as $s){                
            ?>
                <tr>
                  <th scope="row">{{$s['skor_id']}}.</th>
                  <td>< {{$s['skor_max']}}</td>
                  <td>{{$s['skor_deskripsi']}}</td>
                  <td><img src="{{$s['skor_icon']}}" alt="" /></td>
                </tr>
                <?php
              }  
            ?>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
{{--
<div class="p-2 bg-success">
  <p class="text-light">
    <strong>Detail Info</strong> <br />
    Kecamatan X Kelurahan X RW X <br />
    Skor <br />
    Status <br />
  </p>
</div>
--}}

{{-- PEMANGGILAN MAP --}}
{{-- 
<div class="mt-2" style="height: 500px; width: 100%;" id="map"></div>

<script src="{{ asset('assets-the-event/js/googlemap.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&callback=initMap" async defer></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
  packages:['geochart'],
  mapsApiKey: '{{env('GOOGLE_API_KEY')}}'
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable([
            ['State', 'Value'],
            ['Aceh',1],
            ['Sumatera Utara',2],
            ['Sumatera Barat',3],
            ['Riau',4],
            ['Jambi',5],
            ['Sumatera Selatan',6],
            ['Bengkulu',7],
            ['Lampung',8],
            ['Kepulauan Bangka Belitung',9],
            ['Kepulauan Riau',10],
            ['Dki Jakarta',11],
            ['Jawa Barat',12],
            ['Jawa Tengah',13],
            ['Di Yogyakarta',14],
            ['Jawa Timur',15],
            ['Banten',16],
            ['Bali',17],
            ['Nusa Tenggara Barat',18],
            ['Nusa Tenggara Timur',19],
            ['Kalimantan Barat',20],
            ['Kalimantan Tengah',21],
            ['Kalimantan Selatan',22],
            ['Kalimantan Timur',23],
            ['Kalimantan Utara',24],
            ['Sulawesi Utara',25],
            ['Sulawesi Tengah',26],
            ['Sulawesi Selatan',27],
            ['Sulawesi Tenggara',28],
            ['Gorontalo',29],
            ['Sulawesi Barat',30],
            ['Maluku',31],
            ['Maluku Utara',32],
            ['Papua Barat',33],
            ['Papua',34],

        ]);

        var options = {
          region: 'ID',
          displayMode: 'regions',
          resolution: 'provinces',
          legend:  {textStyle: {color: 'blue', fontSize: 16}}
			};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart.draw(data, options);
}
   </script>
  <div id="regions_div" style="width: 100%; height: 500px;"></div> --}}
@endsection
