<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <style>
    table,
    td,
    th {
      border: 1px solid black;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th {
      height: 50px;
      text-align: center ;
    }
  </style>
</head>

<body>
  <img src="{{url("assets/img/logo_doc.png")}}"  style="float:left;width:auto;height:100px;margin-top:10px">
  <h2 style="text-align:center">PEMERINTAH KABUPATEN BUNGO</h2>
  <h2 style="text-align:center">SEKRETARIAT DEWAN PERWAKILAN RAKYAT DAERAH</h2>
  <h4 style="text-align:center">Jalan : R.M Thaher Telp. (0747) 21245</h4>
  <hr>
  <h2 style="text-align:center">LAPORAN PEGAWAI</h2>
  <hr>

  <br>
  <center>
  <table>
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Golongan</th>
      <th>Bagian</th>
      <th>TTL</th>
      <th>Jenis Kelamin</th>
      <th>No HP</th>
      <th>Agama</th>
      <th>Jabatan</th>
      <th>Status Kawin</th>
      <th>Status Pegaw</th>
      <th>Pend. Akhir</th>
      <th>Mulai Kerja</th>
    </tr>
    @foreach($data as $k => $v)
    <tr>
      <td>{{($k+1)}}</td>
      <td>{{$v->nip}}</td>
      <td>{{$v->nama_pegawai}}</td>
      <td>{{$v->gol->nama_gol}}</td>
      <td>{{$v->sub_bagian->bagian->nama_divisi}} - {{$v->sub_bagian->nama_sub}}</td>
      <td>{{$v->tempat_lahir}},{{date("d-m-Y",strtotime($v->tgl_lahir))}}</td>
      <td>{{$v->jk}}</td>
      <td>{{$v->no_hp}}</td>
      <td>{{$v->agama}}</td>
      <td>{{$v->jabatan}}</td>
      <td>{{$v->status_perkawinan}}</td>
      <td>{{$v->status_pegawai}}</td>
      <td>{{($v->pegawai_pendidikans->count() > 0)?$v->pegawai_pendidikans[(count($v->pegawai_pendidikans) - 1)]->tingkat_pend:""}}</td>
      <td>{{date("d-m-Y",strtotime($v->mulai_kerja))}}</td>
    </tr>
    @endforeach
  </table>

  <p style="text-align:right">BUNGO, {{date("d-m-Y")}}</p>
  <p style="text-align:right">Kepala Bagian Umum & Keuangan</p>
  <br>
  <br>
  <p style="text-align:right">Indrayani</p>
</center>
</body>

</html>
