<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{env('APP_NAME')}}</title>        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<style>
  body {         
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 10px;
  }

  table {
  border-collapse: collapse;
  border-spacing: 0;  
  }

  td { 
  border: 1px solid black;    
  padding: 0.5rem;
  text-align: center;
  }

</style>
<body>
{{-- <h3>PUSPA ABADI SETYA</h3> --}}
<table border="0" cellspacing="0" cellpadding="5" style="width: 100%">
  <tr>
    <th>Curriculum Vitae</th>
    <th>履歴書</th>
    <th>Tanggai dibuat: {{date('d-m-Y')}}</th>
  </tr>
</table>
<table style="width: 100%">
  <tr>
    <td style="background-color: rgb(244, 175, 132);">Name</td>
    <td colspan="4">{{auth()->user()->name}}</td>    
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132);">Tanggal Lahir</td>
    <td>{{$data->date_birth}}</td>
    <td style="background-color: rgb(244, 175, 132);">Jenis Kelamin</td>
    <td>{{($data->gender) ? 'Perempuan' : 'Laki-laki'}}</td>
    <td style="background-color: rgb(244, 175, 132);">Foto Background Putih</td>
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132);">Alamat</td>
    <td colspan="3">{{$data->alamat}}</td>
    <td>
      <h1 style="text-align: center; color:red">TEMP 3X4</h1>
    </td>
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132);">No. Telpon</td>
    <td>{{auth()->user()->hp}}</td>
    <td style="background-color: rgb(244, 175, 132);">Email</td>
    <td colspan="2">{{auth()->user()->email}}</td>    
  </tr>
  <tr>
    <td rowspan="4" style="background-color: rgb(244, 175, 132);">Informasi</td>
    <td style="background-color: rgb(244, 175, 132);">Tinggi</td>
    <td style="background-color: rgb(244, 175, 132);">Berat</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Agama</td>    
  </tr>
  <tr>
    <td>{{$data->tall}}</td>
    <td>{{$data->weight}}</td>
    <td colspan="2">
      @php
      $rel = [null,'Islam','Kristen','Hindu','Buddha','Konghucu'];
      @endphp
      {{$rel[$data->religion]}}  
    </td>    
  </tr>
  <tr>    
    <td style="background-color: rgb(244, 175, 132);">Status</td>
    <td colspan="3" style="background-color: rgb(244, 175, 132);">Golongan Darah</td>  
  </tr>
  <tr>
    <td>{{($data->marriage == 0) ? 'Belum Kawin' : 'Kawin'}}</td>
    <td colspan="3">{{$data->blood}}</td>   
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132);">Hobbi</td>
    <td colspan="4">{{$data->hobbies}}</td>
  </tr>
  <tr>
    <td colspan="5" style="background-color: #3F51B5; color:white">Riwayat Pendidikan</td>
  </tr>
  <tr>    
    <td colspan="3" style="background-color: rgb(244, 175, 132);">Periode</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Nama Sekolah</td>  
  </tr>
  @php
  $job = json_decode($data->study);
  @endphp
  @for ($i = 0; $i < count($job); $i++)      
  <tr>
    <td colspan="3">{{$job[$i][1]}}</td>
    <td colspan="2" >{{$job[$i][0]}}</td>
  </tr>
  @endfor
  <tr>
    <td colspan="5" style="background-color: #3F51B5; color:white">Riwayat Pekerjaan</td>
  </tr>
  <tr>    
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Nama Perusahaan</td>  
    <td style="background-color: rgb(244, 175, 132);">Periode</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Pekerjaan</td>  
  </tr>
  @php
  $job = json_decode($data->job);
  @endphp
  @for ($i = 0; $i < count($job); $i++)      
  <tr>
    <td colspan="2">{{$job[$i][0]}}</td>
    <td>{{$job[$i][1]}}</td>
    <td colspan="2">{{$job[$i][2]}}</td>
  </tr>
  @endfor
  <tr>
    <td colspan="5" style="background-color: rgb(244, 175, 132);">Struktur Keluarga</td>  
  </tr>
  <tr>    
    <td style="background-color: rgb(244, 175, 132);">Peran</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Nama</td>  
    <td colspan="2" style="background-color: rgb(244, 175, 132);">Umur</td>  
  </tr>
  @php
  $dad = json_decode($data->dad);
  @endphp
  <tr>
    <td>Ayah</td>
    @for ($i = 0; $i < count($dad); $i++)      
    <td colspan="2">{{$dad[$i]}}</td>        
    @endfor
  </tr>
  @php
  $mom = json_decode($data->mom);
  @endphp
  <tr>
    <td>Ibu</td>
    @for ($i = 0; $i < count($mom); $i++)      
    <td colspan="2">{{$mom[$i]}}</td>        
    @endfor
  </tr>
  @php
  $bro = json_decode($data->bro);
  @endphp
  <tr>
    <td>Kakak</td>
    @for ($i = 0; $i < count($bro); $i++)      
    <td colspan="2">{{$bro[$i]}}</td>        
    @endfor
  </tr>
  @php
  $sis = json_decode($data->sis);
  @endphp
  <tr>
    <td>Adik</td>
    @for ($i = 0; $i < count($sis); $i++)      
    <td colspan="2">{{$sis[$i]}}</td>        
    @endfor
  </tr>
</table>

</body>
</html>