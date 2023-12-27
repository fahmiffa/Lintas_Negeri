@php
header('Content-Type: application/msword');
header('Content-Disposition: attachment;filename="'.$name);
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{$name}}</title>             
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap" rel="stylesheet">

</head>

<style>
  body {         
    font-family: 'Noto Sans JP', sans-serif;
    font-size: 10px;
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
<table style="width: 100%; border-collapse:collapse; border: 1px solid black; text-align:center">
  <tr>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black;  border-collapse:collapse; border: 1px solid black;">Name</td>
    <td colspan="4" style="border: 1px solid black;">{{$apply->user->name}}</td>    
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Tanggal Lahir</td>
    <td style="border: 1px solid black;">{{$data->date_birth}}</td>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Jenis Kelamin</td>
    <td style="border: 1px solid black;">{{($data->gender) ? 'Perempuan' : 'Laki-laki'}}</td>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Foto Background Putih</td>
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Alamat</td>
    <td colspan="3" style="border: 1px solid black;">{{$data->alamat}}</td>
    <td style="border: 1px solid black;">
      <h1 style="text-align: center; color:red">TEMP 3X4</h1>
    </td>
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">No. Telpon</td>
    <td style="border: 1px solid black;">{{auth()->user()->hp}}</td>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Email</td>
    <td colspan="2" style="border: 1px solid black;">{{auth()->user()->email}}</td>    
  </tr>
  <tr>
    <td rowspan="4" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Informasi</td>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Tinggi</td>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Berat</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Agama</td>    
  </tr>
  <tr>
    <td style="border: 1px solid black;">{{$data->tall}}</td>
    <td style="border: 1px solid black;">{{$data->weight}}</td>
    <td colspan="2" style="border: 1px solid black;">
      @php
      $rel = [null,'Islam','Kristen','Hindu','Buddha','Konghucu'];
      @endphp
      {{$rel[$data->religion]}}  
    </td>    
  </tr>
  <tr>    
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Status</td>
    <td colspan="3" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Golongan Darah</td>  
  </tr>
  <tr>
    <td style="border: 1px solid black;">{{($data->marriage == 0) ? 'Belum Kawin' : 'Kawin'}}</td>
    <td colspan="3" style="border: 1px solid black;">{{$data->blood}}</td>   
  </tr>
  <tr>
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Hobbi</td>
    <td colspan="4" style="border: 1px solid black;">{{$data->hobbies}}</td>
  </tr>
  <tr>
    <td colspan="5" style="background-color: #3F51B5; color:white; border: 1px solid black; ">Riwayat Pendidikan</td>
  </tr>
  <tr>    
    <td colspan="3" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Periode</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Nama Sekolah</td>  
  </tr>
  @php
  $job = json_decode($data->study);
  @endphp
  @for ($i = 0; $i < count($job); $i++)      
  <tr>
    <td colspan="3" style="border: 1px solid black;">{{$job[$i][1]}}</td>
    <td colspan="2" style="border: 1px solid black;">{{$job[$i][0]}}</td>
  </tr>
  @endfor
  <tr>
    <td colspan="5" style="background-color: #3F51B5; color:white; border: 1px solid black; ">Riwayat Pekerjaan</td>
  </tr>
  <tr>    
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Nama Perusahaan</td>  
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Periode</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Pekerjaan</td>  
  </tr>
  @php
  $job = json_decode($data->job);
  @endphp
  @for ($i = 0; $i < count($job); $i++)      
  <tr>
    <td colspan="2" style="border: 1px solid black;">{{$job[$i][0]}}</td>
    <td style="border: 1px solid black;">{{$job[$i][1]}}</td>
    <td colspan="2" style="border: 1px solid black;">{{$job[$i][2]}}</td>
  </tr>
  @endfor
  <tr>
    <td colspan="5" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Struktur Keluarga</td>  
  </tr>
  <tr>    
    <td style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Peran</td>
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Nama</td>  
    <td colspan="2" style="background-color: rgb(244, 175, 132); border: 1px solid black; ">Umur</td>  
  </tr>
  @php
  $dad = json_decode($data->dad);
  @endphp
  <tr>
    <td style="border: 1px solid black;">Ayah</td>
    @for ($i = 0; $i < count($dad); $i++)      
    <td colspan="2" style="border: 1px solid black;">{{$dad[$i]}}</td>        
    @endfor
  </tr>
  @php
  $mom = json_decode($data->mom);
  @endphp
  <tr>
    <td style="border: 1px solid black;">Ibu</td>
    @for ($i = 0; $i < count($mom); $i++)      
    <td colspan="2" style="border: 1px solid black;">{{$mom[$i]}}</td>        
    @endfor
  </tr>
  @php
  $bro = json_decode($data->bro);
  @endphp
  <tr>
    <td style="border: 1px solid black;">Kakak</td>
    @for ($i = 0; $i < count($bro); $i++)      
    <td colspan="2" style="border: 1px solid black;">{{$bro[$i]}}</td>        
    @endfor
  </tr>
  @php
  $sis = json_decode($data->sis);
  @endphp
  <tr>
    <td style="border: 1px solid black;">Adik</td>
    @for ($i = 0; $i < count($sis); $i++)      
    <td colspan="2" style="border: 1px solid black;">{{$sis[$i]}}</td>        
    @endfor
  </tr>
</table>

</body>
</html>