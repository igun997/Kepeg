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
  <h2 style="text-align:center">LAPORAN KENAIKAN</h2>
  <hr>

  <br>
  <center>
  <table>
    <tr>
      <th>No</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Gol Asal</th>
      <th>Gol Tujuan</th>
      <th>TTL</th>
      <th>Jenis Kelamin</th>
      <th>No HP</th>
      <th>Jabatan</th>
      <th>Tanggal Pengajuan</th>
      <th>Status</th>
    </tr>
    <!-- divisi_asal -->
    @foreach($data as $k => $v)
    <tr>
      <td>{{($k+1)}}</td>
      <td>{{$v->pegawai->nip}}</td>
      <td>{{$v->pegawai->nama_pegawai}}</td>
      <td>{{$v->gol_asal->nama_gol}}</td>
      <td>{{$v->gol_tujuan->nama_gol}}</td>
      <td>{{$v->pegawai->tempat_lahir}} , {{date("d-m-Y",strtotime($v->pegawai->tgl_lahir))}}</td>
      <td>{{$v->pegawai->jk}}</td>
      <td>{{$v->pegawai->no_hp}}</td>
      <td>{{$v->pegawai->jabatan}}</td>
      <td>{{date("d-m-Y",strtotime($v->tanggal))}}</td>
      <td>{{ucfirst($v->status)}}</td>
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
