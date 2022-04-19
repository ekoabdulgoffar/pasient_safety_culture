@extends('dist.nolayout') 

@section('title') 
PSC 2022 | Isi Kuesioner 
@endsection 

@section('content-header-info')
<div class="d-sm-flex align-items-center justify-content-end">  
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page">Questionnaire History</li>
    <li class="breadcrumb-item active" aria-current="page">Isi Kuesioner - {{$kuesioner['kuesioner_deskripsi']}}</li>
  </ol>
</div>
<div class="card">
  <div class="card-header p-1 bg-primary"></div>
  <div class="card-body" style="font-family: Arial, Helvetica, sans-serif">
    <p class="h5">Questionnaire of Patient Safety Culture in Dental Health Services in Indonesia</p>
    <hr>
    <p class="mb-0">Happy filling</p>
    {{-- <p class="text-justify">
      Kepada Yth :
    <br><br>
    Sejawat dokter gigi di Indonesia 
    <br>
    Asswrwb, 
    <br><br>
    &nbsp;&nbsp; Perlu diketahui bahwa keselamatan (𝘴𝘢𝘧𝘦𝘵𝘺) telah menjadi isu yang mendunia khususnya pada  layanan kesehatan. Data  kejadian tidak diharapkan (KTD atau 𝘈𝘥𝘷𝘦𝘳𝘴𝘦 𝘌𝘷𝘦𝘯𝘵) di berbagai negara di dunia seperti Amerika , Colorado,Utah,New York serta Inggris, Denmark, Asia dan Australia, menjadi cikal bakal berbagai negara segera mengembangkan Sistem Keselamatan Pasien.¹  Apalagi saat ini dunia sedang dihadapkan pada Pandemi Global dengan adanya virus Covid 19, dimana data WHO menunjukkan bahwa virus ini sudah banyak menelan korban , bahkan pada dokter maupun tenaga medis yang merupakan profesi yang berisiko tinggi.² Per 12 Juli  2021, kasus virus Covid-19 telah menginfeksi lebih dari 200 negara di dunia dengan update data adalah  186.638.285 kasus, 397.892 kasus baru, dan 4.035.037 wafat  termasuk di Indonesia  ada 2.567.630 kasus dengan 67.355 orang wafat.³
    <br><br>
    &nbsp;&nbsp;Pada bidang kedokteran gigi , dokter gigi berisiko tinggi terhadap infeksi silang dan dapat menjadi orang pertama yang kontak karena dekat dengan pasien yang berpotensi menjadi sumber penularan.⁴ Kondisi ini membuat semua pihak  melakukan tindakan kewaspadaan standar khususnya penerapan 𝘜𝘯𝘪𝘷𝘦𝘳𝘴𝘢𝘭 𝘗𝘳𝘦𝘤𝘢𝘶𝘵𝘪𝘰𝘯 dari WHO termasuk dalam menghadapi virus Covid-19 ini ⁵, Hal ini membuka wawasan dunia tentang pentingnya faktor budaya keselamatan pasien khususnya bagi tenaga medis.²  Terkait dengan upaya-upaya Keselamatan Pasien di faskes primer dan sekunder (Klinik, Puskesmas dan Rumah Sakit) , diyakini bahwa upaya tersebut akan menciptakan budaya keselamatan/𝘴𝘢𝘧𝘦𝘵𝘺 𝘤𝘶𝘭𝘵𝘶𝘳𝘦 serta merupakan langkah pertama dalam tahapan mencapai Keselamatan Pasien yang berkaitan dengan manajemen risiko dan keselamatan⁶ termasuk di bidang layanan kedokteran gigi.
      <br><br>
      &nbsp;&nbsp;Dengan meningkatnya budaya keselamatan pasien di fasilitas layanan kesehatan   diharapkan kepercayaan masyarakat terhadap layanan kesehatan  termasuk kesehatan gigi dan mulut dapat meningkat, sehingga dapat meningkatkan angka kunjungan pasien ke fasilitas kesehatan gilut. Sehubungan dengan hal tersebut  akan dilakukan penelitian tentang analisis gambaran budaya keselamatan pasien terhadap dokter gigi  pada faskes primer (klinik gigi, puskesmas, klinik pratama)  dan sekunder (RS/RSGM) di Indonesia. 
      <br><br>
      &nbsp;&nbsp;Apabila berkenan mohon bantuan Sejawat untuk dapat mengisi kuesioner penelitian ini. Penelitian ini menggunakan 𝘚𝘢𝘧𝘦𝘵𝘺 𝘈𝘵𝘵𝘪𝘵𝘶𝘥𝘦 𝘘𝘶𝘦𝘴𝘪𝘰𝘯𝘦𝘳 versi Indonesia - kuesioner dari  Sexton et al ⁷,  Gabrani A et al ⁸ , Ying Li et al ⁹ dan Cheng HC ¹⁰ yang telah dialih bahasakan ke Bahasa Indonesia.
    <br><br>
    &nbsp;&nbsp;Kuesioner ditujukan kepada dokter gigi (𝘎𝘦𝘯𝘦𝘳𝘢𝘭 𝘗𝘳𝘢𝘤𝘵𝘪𝘵𝘪𝘰𝘯𝘦𝘳) yang berpraktik pada fasilitas kesehatan primer dan sekunder di Indonesia . Sejawat hanya perlu waktu sekitar 10 menit untuk melengkapi kuesioner ini. Semoga berkenan dan terima kasih atas partisipasinya mengisi kuesioner.
    </p> --}}
  </div>
</div>
<div class="my-2">
  <a href="{{ url('/user-kuesioner') }}" class="btn btn-outline-primary px-5">
    <span class="fa fa-home"></span> &nbsp; Back to home
  </a>
</div>
@endsection 

@section('content')
<link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />

<form id="accordion" action="{{ url('/isi-kuesioner') }}" method="POST">
  @csrf
  <input type="hidden" name="kuesioner_id" value="{{$kuesioner['kuesioner_id']}}" />
  
  @foreach ($pertanyaan as $i => $p)
  {{-- MODEL 2 --}}
    @foreach ($kelompok_pertanyaan as $index => $k)
        @if ($k['kelompok_pertanyaan_id'] == $p[0]['kelompok_pertanyaan_id'])
            @php
            $kelompok = "collaps_".$k['kelompok_pertanyaan_id'];
            $kelompok_deskripsi = $k['kelompok_pertanyaan_deskripsi'];
            $icon = "icon_".$k['kelompok_pertanyaan_id'];
            $myaccordian_id = "accor_".$index;
            $nextaccordian_id = "accor_".($index+1);
            $backaccordian_id = "accor_".($index-1);
            break;
            @endphp
        @endif
    @endforeach
    @if ($myaccordian_id == "accor_0")
    <div id="{{$myaccordian_id}}" class="card mb-3 collapse show" aria-labelledby="headingOne" data-parent="#accordion">
    @else
    <div id="{{$myaccordian_id}}" class="card mb-3 collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
    @endif
    <div class="card-header p-1 bg-primary"></div>
    <div class="card-body">
      <div class="row" >
        <div class="col">
          <p class="font-weight-bold">
            {{$kelompok_deskripsi}}
          </p>
        </div>
        <div class="col">
        </div>
      </div>
      <br>
      <table class="table">
        <tr>
          <td colspan="2">Pertanyaan</td>
          {{-- <td class="text-center">Jawaban</td> --}}
          @php
              $param = json_decode($jenis_pertanyaan[0]['jenis_pertanyaan_parameter'], true);
          @endphp
          @foreach ($param as $prm)
          <td>{{$prm['param']}}</td>
          @endforeach
        </tr>
        <tr>
        </tr>
        @foreach ($p as $key=>$pertanyaan_satuan)
        <tr style="background-color: whitesmoke;" class="text-dark">
          <td class="align-top p-2 font-weight-bold">{{$key+1}}.</td>
          <td class="w-100 p-2">
            <p class="mb-1 font-weight-bold">{{$pertanyaan_satuan['pertanyaan_']}} <span class="text-danger">*</span></p>
            <br />
          </td>
          @foreach ($jenis_pertanyaan as $jp)
              @if ($jp['jenis_pertanyaan_id'] == $pertanyaan_satuan['jenis_pertanyaan_id'])
                  @php
                      $param = json_decode($jp['jenis_pertanyaan_parameter'], true);
                  @endphp
                  @if (count($param) > 0)
                      @foreach ($param as $prm)
                      <td>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" 
                          name="p{{$pertanyaan_satuan['pertanyaan_id']}}" 
                          id="{{$pertanyaan_satuan['pertanyaan_id']}}"
                          @if ($prm['poin'] != -1)
                          value="{{$prm['nilai']}}" 
                          @else
                          value="{{$prm['param']}}" 
                          @endif
                          required/>
                        </div>
                      </td>
                      @endforeach
                  @endif
              @endif
          @endforeach
        </tr>
        <tr style="height: 15px;"></tr>
        @endforeach
      </table>
      @if ($i+1 == count($pertanyaan))      
      <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#{{$backaccordian_id}}" aria-expanded="true" aria-controls="collapseOne">Back</button>
      <input type="submit" value="Finish" class="btn btn-primary" onclick="return confirm('Are you sure you want to submit this answer?')" />
      @else
      @if ($myaccordian_id != "accor_0")
      <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#{{$backaccordian_id}}" aria-expanded="true" aria-controls="collapseOne">Back</button>
      @endif
      <button id="c-button-{{$myaccordian_id}}" type="button" onclick="checkForm('{{$myaccordian_id}}')" class="btn btn-outline-primary">Next</button>
      <button style="display: none" id="n-button-{{$myaccordian_id}}" type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#{{$nextaccordian_id}}" aria-expanded="true" aria-controls="collapseOne">N</button>
      @endif
    </div>
    </div>
    {{-- END MODEL 2 --}}
  @endforeach
</form>
<br>
<script src="{{ asset('assets/js/user_isi_kuesioner.js') }}"></script>
@endsection
