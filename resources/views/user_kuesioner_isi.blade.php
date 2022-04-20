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
  <div id="accor_-1" class="card mb-3 collapse show" data-parent="#accordion">
    <div class="card-header p-1 bg-primary"></div>
    <div class="card-body" style="font-family: Arial, Helvetica, sans-serif">
      <p class="h5">Budaya Keselamatan Pasien pada Layanan Kedokteran Gigi di Indonesia</p>
      <hr>
      {{-- <p class="mb-0">Happy filling</p> --}}
      <p class="text-justify">
        Kepada Yth :
      <br><br>
      Sejawat dokter gigi di Indonesia 
      <br>
      Asswrwb,
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Perlu diketahui bahwa keselamatan (safety) telah menjadi isu yang mendunia khususnya pada  layanan kesehatan. Data  kejadian tidak diharapkan (KTD atau Adverse Event ) di berbagai negara di dunia seperti Amerika,Colorado,Utah,New York, Inggris, Denmark, Asia dan Australia, menjadi cikal bakal berbagai negara segera mengembangkan Sistem Keselamatan Pasien.<sup>1</sup> Apalagi saat ini dunia sedang dihadapkan pada Pandemi Global dengan adanya virus Covid 19, dimana data WHO menunjukkan bahwa virus ini sudah banyak menelan korban , bahkan pada dokter maupun tenaga medis yang merupakan profesi yang berisiko tinggi.<sup>2</sup> Per 14 April 2022  kasus virus Covid-19 telah menginfeksi lebih dari 200 negara di dunia dengan update data adalah 500.186.525   kasus dengan  6.190.349 wafat  termasuk di Indonesia  ada 6.037.742  kasus dengan 155.794 orang wafat dengan jumlah yang telah divaksin di seluruh dunia adalah  11.294.502.059.<sup>3</sup>
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Pada bidang kedokteran gigi , dokter gigi berisiko tinggi terhadap infeksi silang dan dapat menjadi orang pertama yang kontak karena dekat dengan pasien yang berpotensi menjadi sumber penularan.<sup>4</sup> Kondisi ini membuat semua pihak   melakukan tindakan kewaspadaan standar khususnya penerapan 𝘜𝘯𝘪𝘷𝘦𝘳𝘴𝘢𝘭 𝘗𝘳𝘦𝘤𝘢𝘶𝘵𝘪𝘰𝘯 dari WHO termasuk dalam menghadapi virus Covid-19 ini <sup>5</sup>, Hal ini membuka wawasan dunia tentang pentingnya faktor budaya keselamatan pasien khususnya bagi tenaga medis.<sup>2</sup> Terkait dengan upaya-upaya Keselamatan Pasien di faskes primer dan sekunder, diyakini bahwa upaya tersebut akan menciptakan budaya keselamatan/𝘴𝘢f𝘦𝘵𝘺 𝘤𝘶𝘭𝘵𝘶𝘳𝘦  serta  merupakan langkah pertama dalam tahapan mencapai Keselamatan Pasien yang berkaitan dengan manajemen risiko dan keselamatan<sup>6</sup> termasuk di bidang layanan kedokteran gigi.
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Dengan meningkatnya budaya keselamatan pasien di fasilitas layanan kesehatan   diharapkan kepercayaan masyarakat terhadap layanan kesehatan  termasuk kesehatan gigi dan mulut dapat meningkat, sehingga dapat meningkatkan angka kunjungan pasien ke fasilitas kesehatan gilut. Telah dilakukan penelitian tentang analisis gambaran budaya keselamatan pasien terhadap dokter gigi  pada faskes primer (klinik gigi, puskesmas, klinik pratama)  dan sekunder (RS/RSGM) di Indonesia. 
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Penelitian ini menggunakan kuesioner Budaya Keselamatan Pasien ( Safety Attitude Quesioner versi Indonesia) - kuesioner dari Sexton et al <sup>7</sup>,  Gabrani A et al <sup>8</sup> , Ying Li et al <sup>9</sup> dan Cheng HC <sup>10</sup>yang telah dialih bahasakan ke Bahasa Indonesia (SAQ-Indo)<sup>11</sup>. SAQ-Indo mencakup enam dimensi dan berisi 30 pertanyaan, yang terdiri dari iklim keselamatan (safety climate) , iklim kerja tim (teamwork climate), kepuasan kerja (job satisfaction), identifikasi stres (stress recognition) , persepsi manajemen (perception of management) dan kondisi kerja (working condition).  <sup>8,9,12</sup>
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Kuesioner ini dapat digunakan oleh semua  tenaga kesehatan  dalam hal ini khususnya adalah  kepada tenaga kesehatan dibidang kedokteran gigi, seperti dokter gigi (general practitioner) dokter gigi spesialis, tenaga kesehatan yang berada di fasilitas kesehatan primer dan sekunder di Indonesia. 
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Sebelum mengisi kuesioner ada video 1 yang berisi tentang Pengantar Budaya Keselamatan Pasien. Kemudian Sejawat dipersilahkan mengisi kuesioner dan hanya perlu waktu sekitar 10 menit untuk melengkapi kuesioner ini.
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Hasil dari Kuesioner ini adalah berupa luaran Nilai Budaya Keselamatan Pasien yang terdiri dari 4(empat) kategori, yaitu Baik Sekali, Baik, Sedang dan Kurang. Nilai Budaya Keselamatan Pasien akan keluar setelah Sejawat melakukan submit pada kuesioner. 
      <br><br>
      &nbsp;&nbsp;&nbsp;&nbsp;Setelah hasil penilaian keluar, silahkan melanjutkan dengan melihat video Edukasi kedua yaitu tentang Penerapan Budaya Keselamatan Pasien pada bidang kedokteran gigi . Kemudian sejawat dapat melakukan pengisian kuesioner ulang. Diharapkan setelah itu Nilai Budaya Keselamatan Pasien sejawat akan meningkat. Dengan harapan sudah terdapat perubahan persepsi dan perilaku terhadap budaya keselamatan sehingga akan membawa pengaruh positif bagi sejawat dalam berpraktik khususnya dalam mencegah terjadinya Kejadian Tidak Diinginkan (KTD/Adverse Events)
      <br><br>
      Demikian, Semoga berkenan dan terima kasih atas partisipasinya dalam mengisi kuesioner.
      <br><br>
      drg. Mita Juliawati,MARS
      <br>
      Mahasiswa Program S3 - Fakultas Kedokteran Gigi Universitas Indonesia 
      <br>
      Telp : <a href="https://wa.me/+6281290888939" target="_blank"> 0812 90 888 939</a>
      <br>
      Email : <a href="mailto:penelitian.psc.mita2020@gmail.com">penelitian.psc.mita2020@gmail.com</a>
      <br><br>
      <b>Catatan : Definisi yang berhubungan dengan keselamatan pasien </b>
      <br><br>
      <b>Keselamatan Pasien</b> adalah segala jenis upaya untuk menghindari / mencegah pasien dari cedera atau kejadian tidak diharapkan lainnya selama proses perawatan. terkait dengan asuhan pasien, insiden yang dapat dicegah atau yang seharusnya tidak terjadi, dan sudah dikategorikan sebagai suatu disiplin<sup>13</sup> serta suatu sistem dimana fasilitas kesehatan dalam hal ini klinik atau rumah sakit membuat asuhan pasien lebih aman.<sup>14</sup>
      <br><br>
      <b>Budaya Keselamatan Pasien</b> adalah  nilai-nilai yang dibagikan kepada seluruh anggota di dalam sebuah organisasi tentang hal yang dianggap penting, keyakinan mereka tentang bagaimana hal-hal terjadi di sebuah organisasi, serta interaksi dari hal-hal tersebut dengan unit kerja,struktur serta sistem organisasi yang mengutamakan  keselamatan pasien.<sup>15</sup>
      <br>
      @php
          $daftarIstilahArray = array(
            array("Kompromi","persetujuan dengan jalan damai"),
            array("Konstruktif","constructively , membina,membangun,memperbaiki"),
            array("Perawat","perawat gigi / asisten dokter gigi, terapis gigi mulut"),
            array("Personil","SDM (sumber daya manusia) , staf medis dan non medis"),
            array("Performa","performance, hal melakukan, penampilan  "),
            array("Supervisi","pengawasan, pengontrolan"),
      );
      @endphp
      <table>
        <tr>
          <td colspan="2"><b>Daftar Istilah</b><sup>16</sup> <i>(Glossary)</i></td>
        </tr>
        @foreach ($daftarIstilahArray as $key=>$item)
            <tr>
              <td>{{$key+1}}. {{$item[0]}}</td>
              <td>: {{$item[1]}}</td>
            </tr>
        @endforeach        
      </table>
      <br>
      @php
          $daftarPustakaArray = array(
            "Kohn LT, Corrigan JM, Donaldson MS. To Err Is Human Building a Safer Health System. Washington,DC: National Academies Press; 2000. doi:10.17226/9728",
            "Pruc M, Golik D, Szarpak L, Adam I, Smereka J. COVID-19 in healthcare workers. Am J Emerg Med. 2020;158984(April):1. doi:10.1016/j.ajem.2020.05.017",
            "WHO. Overview Data Covid-19 Last updated: 2022/4/14. https://covid19.who.int/. Published 2022.",
            "Kamate SK, Sharma S, Thakar S, et al. Assessing knowledge, attitudes and practices of dental practitioners regarding the covid-19 pandemic: A multinational study. Dent Med Probl. 2020;57(1):11-17. doi:10.17219/DMP/119743",
            "WHO. Standard Precautions in Health Care. In: Infection Control. Switzerland: WHO; 2007. doi:10.5005/jp/books/12675_65",
            "WHO. Better Knowledge for Safer Care: Human Factors in Patient Safety.; 2009. http://www.who.int/patientsafety/research/methods_measures/human_factors/human_factors_review.pdf.",
            "Sexton JB, Helmreich RL, Neilands TB, et al. The Safety Attitudes Questionnaire: Psychometric properties, benchmarking data, and emerging research. BMC Health Serv Res. 2006;6:1-10. doi:10.1186/1472-6963-6-44",
            "Gabrani A, Hoxha A, Simaku A GJ. Application of the Safety Attitudes Questionnaire (SAQ) in Albanian hospitals: a cross-sectional study. BMJ Open 2015. 2015;5:1-10. doi:10.1136/bmjopen-2014-006528",
            "Li Y, Zhao X, Zhang X, et al. Validation study of the safety attitudes questionnaire (SAQ) in public hospitals of Heilongjiang province, China. PLoS One. 2017;12(6):1-11. doi:10.1371/journal.pone.0179486",
            "Cheng H, Yen AM, Lee Y. ScienceDirect Factors affecting patient safety culture among dental healthcare workers : A nationwide cross-sectional survey. J Dent Sci. 2019;14(3):263-268. doi:10.1016/j.jds.2018.12.001",
            "Juliawati M, Darwita RR, Adiatman M, Lestari F. Patient Safety Culture in Dentistry Analysis Using the Safety Attitude Questionnaire in DKI Jakarta , Indonesia : A Cross-Cultural Adaptation and Validation Study. J Patient Saf. 2022;00(00):1-8.",
            "Hodgen A, Ellis L, Churruca K, Bierbaum M. Safety Culture Assessment in Health Care: A Review of the Literature on Safety Culture Assessment Modes. Sydney: the Australian Commission on Safety and Quality in Health Care; 2017. https://www.safetyandquality.gov.au/wp-content/uploads/2017/10/Safety-Culture-Assessment-in-Health-Care-A-review-of-the-literature-on-safety-culture-assessment-modes.pdf.",
            "WHO. WHO - Patient Safety. https://www.who.int/teams/integrated-health-services/patient-safety. Published 2021.",
            "Komite Keselamatan Pasien Rumah Sakit. Pedoman Pelaporan Insiden Keselamatan Pasien (IKP) Patient Safety Incident Report. Kementerian Kesehatan RI; 2015.",
            "Singer SJ, Tucker AL. Creating a Culture of Safety in Hospitals.; 2014. https://www.researchgate.net/publication/237229005_Creating_a_Culture_of_Safety_in_Hospitals.",
            "KBBI-Daring. Kepuasan. https://kbbi.kemdikbud.go.id/entri/kep. Published 2021.",
          );
      @endphp
      <table>
        <tr>
          <td colspan="2"><b>Daftar Pustaka</b></td>
        </tr>
        @foreach ($daftarPustakaArray as $key=>$item)
            <tr>
              <td class="align-top">{{$key+1}}.&nbsp;&nbsp;&nbsp;</td>
              <td valign="top" >{{$item}}</td>
            </tr>
        @endforeach
      </table>
      </p>
      <br>
      <div class="card card-body border border-secondary mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" id="cmengerti" name="cmengerti" required>
          <label class="form-check-label" for="defaultCheck1">
            Saya menyatakan mengerti dan bersedia untuk mengisi kuesioner <span class="text-danger">*</span>
          </label>
        </div>
      </div>
      <button id="c-button-accor_-1" type="button" onclick="checkCheckbox()" class="btn btn-primary">Next</button>
      <button style="display: none" id="n-button-accor_-1" type="button" class="btn btn-outline-primary" data-toggle="collapse" data-target="#accor_0" aria-expanded="true" aria-controls="collapseOne">N</button>
      <br>
    </div>
  </div>
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
    <div id="{{$myaccordian_id}}" class="card mb-3 collapse hide" aria-labelledby="headingOne" data-parent="#accordion">
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
                          id="i{{$pertanyaan_satuan['pertanyaan_id']}}"
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
      <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#{{$backaccordian_id}}" aria-expanded="true" aria-controls="collapseOne">Back</button>
      <input type="submit" value="Finish" class="btn btn-primary" onclick="return confirm('Are you sure you want to submit this answer?')" />
      @else
      @if ($myaccordian_id != "accor_0")
      <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#{{$backaccordian_id}}" aria-expanded="true" aria-controls="collapseOne">Back</button>
      @endif
      <button type="button" class="btn btn-outline-secondary" data-toggle="collapse" data-target="#accor_-1" aria-expanded="true" aria-controls="collapseOne">Back</button>
      <button id="c-button-{{$myaccordian_id}}" type="button" onclick="checkForm('{{$myaccordian_id}}')" class="btn btn-primary">Next</button>
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
